function click_change_gestion()
	if global_value_click["action"] == "page" then
		changementpage(global_value_click["id"])
		if global_value_click["value"] ~= nil then
		--	for k, v in pairs(global_value_click["value"]) do
		--		global_fitre[k]={}
				global_fitre["id"] = global_value_click["value"]["id"]
				global_fitre["type"] = global_value_click["value"]["type"]
		--	end
		end
	end
	if global_value_click["action"] == "action" then
		if global_value_click["id"] == "reboot" then
			os.reboot()
		elseif global_value_click["id"] == "shutdown" then
			os.shutdown()
		elseif global_value_click["id"] == "edit_config" then
			if global_variable["ip"] ~= "" and global_variable["port"] ~= "" and global_variable["uriapi"] ~= "" and global_variable["urilua"] ~= "" then
				local temp_global_url = global_url
				local temp_global_port = global_port
				local temp_global_api_uri = global_api_uri
				local temp_global_lua_uri = global_lua_uri
				global_url = global_variable["ip"]
				global_port = global_variable["port"]
				global_api_uri = global_variable["uriapi"]
				global_lua_uri = global_variable["urilua"]
				local new_new_version = http_get("version",false)
				local new_http_error_message = http_get("listconfig",true)
				if type(new_http_error_message) == "table" and type(new_new_version) == "table" then
					local file = fs.open(global_config_http,"w")
					file.writeLine("global_url = '"..global_url.."'")
					file.writeLine("global_port = '"..global_port.."'")
					file.writeLine("global_api_uri = '"..global_api_uri.."'")
					file.writeLine("global_lua_uri = '"..global_lua_uri.."'")
					file.writeLine("global_systeme_nom = '"..global_systeme_nom.."'")
					file.writeLine("global_systeme_version = '"..global_systeme_version.."'")
					global_message = global_local_error_message[12]
					recup_http_config()
				else
					if type(new_http_error_message) == "table" and type(new_new_version) ~= "table" then
						global_message = global_local_error_message[22] --erreur - la connexion au serveur LUA ne fonctionne pas
					else
						if new_http_error_message == "db_error" then
							global_message = global_local_error_message[21] --erreur - la connexion au serveur API ne fonctionne pas
						end
					end
					global_url = temp_global_url
					global_port = temp_global_port
					global_api_uri = temp_global_api_uri
					global_lua_uri = temp_global_lua_uri
				end
			else
				global_message = global_local_error_message[2]
			end
		elseif global_value_click["id"] == "disable_message" then
			global_message = ""
			global_compteur_tempo_message_http = 0
		elseif global_value_click["id"] == "setlocalmdp" then
			if global_variable["mdp"] ~= nil and global_variable["confirm"] ~= nil then
				if global_variable["mdp"] ~= "" and global_variable["confirm"] ~= "" then
					if global_variable["mdp"] == global_variable["confirm"] then
						global_login_pc = sha256(global_variable["mdp"])
						save_var_file(global_config_mdp_local, global_login_pc, "global_login_pc")
						global_message = global_local_error_message[11]
						changementpage(10)
					else
						global_message = global_local_error_message[1]
					end
				else
					global_message = global_local_error_message[2]
				end
			else
				global_message = global_local_error_message[2]
			end
		elseif global_value_click["id"] == "changelocalmdp" then
			if global_variable["mdp"] ~= nil and global_variable["confirm"] ~= nil then
				if global_variable["mdp"] ~= "" and global_variable["confirm"] ~= "" then
					if global_variable["mdp"] == global_variable["confirm"] then
						if global_login_pc == sha256(global_variable["ancienmdp"]) then
							global_login_pc = sha256(global_variable["mdp"])
							save_var_file(global_config_mdp_local, global_login_pc, "global_login_pc")
							global_message = global_local_error_message[11]
						else
							global_message = global_local_error_message[3]
						end
					else
						global_message = global_local_error_message[1]
					end
				else
					global_message = global_local_error_message[2]
				end
			else
				global_message = global_local_error_message[2]
			end
		elseif global_value_click["id"] == "localmdp" then
			if global_variable["mdp"] ~= nil then
				if global_variable["mdp"] ~= "" then
					if global_login_pc == sha256(global_variable["mdp"]) then
						changementpage(202)
						global_message = global_local_error_message[10]
					else
						global_message = global_local_error_message[3]
					end
				else
					global_message = global_local_error_message[2]
				end
			else
				global_message = global_local_error_message[2]
			end
		elseif global_value_click["id"] == "rangeliste" then
			rangement_liste(global_value_click["value"])
		elseif global_value_click["id"] == "maj" then
			save_var_file("config/update.lua", global_systeme_version .. "-" .. global_new_version[global_systeme_nom], "update")
			os.reboot()
		elseif global_value_click["id"] == "scroll" then
			global_scroll = global_value_click["value"]
		else
			-- que les commandes http ou ayant besoin d'un retour http
			http_commande(global_value_click["id"])
		end
	end
	if global_value_click["action"] == "variable" then
		global_edit_variable = {nom = global_value_click["id"], type = global_value_click["value"]}
		global_limite_scroll_haut = false
		global_limite_scroll_bas = false
	else
		if global_edit_variable["nom"] ~= nil then
			global_edit_variable = {}
		end
	end
	genere_term_affichage()
end