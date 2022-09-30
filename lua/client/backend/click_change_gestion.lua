function click_change_gestion()
	if global_click["parametre"]["action"] == "page" then
		changementpage(global_click["parametre"]["id"])
		if global_click["parametre"]["filtre"] ~= nil then
			for k, v in pairs(global_click["parametre"]["filtre"]) do
				global_filtre[k] = global_click["parametre"]["filtre"][k]
			end
		end
	end
	if global_click["parametre"]["action"] == "action" then
		if global_click["parametre"]["id"] == "reboot" then
			os.reboot()
		elseif global_click["parametre"]["id"] == "shutdown" then
			os.shutdown()
		elseif global_click["parametre"]["id"] == "edit_config" then
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
				new_new_version = nil
				new_http_error_message = nil
			else
				global_message = global_local_error_message[2]
			end
		elseif global_click["parametre"]["id"] == "disable_message" then
			global_message = ""
			global_compteur_tempo_message_http = 0
		elseif global_click["parametre"]["id"] == "setlocalmdp" then
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
		elseif global_click["parametre"]["id"] == "changelocalmdp" then
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
		elseif global_click["parametre"]["id"] == "localmdp" then
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
		elseif global_click["parametre"]["id"] == "rangeliste" then
			rangement_liste(global_click["parametre"]["valeur"])
		elseif global_click["parametre"]["id"] == "maj" then
			save_var_file("config/update.lua", global_systeme_version .. "-" .. global_new_version[1], "update")
			os.reboot()
		elseif global_click["parametre"]["id"] == "scroll" then
			global_scroll = global_click["parametre"]["valeur"]
		else
			-- que les commandes http ou ayant besoin d'un retour http
			http_commande(global_click["parametre"]["id"])
		end
	end
	if global_click["parametre"]["action"] == "variable" then
		global_edit_variable = {nom = global_click["parametre"]["nom"],type = global_click["parametre"]["type"],xmin = global_click["xmin"],xmax = global_click["xmax"],ymin = global_click["ymin"],ymax = global_click["ymax"],select_sens=false}
		global_limite_scroll_haut = false
		global_limite_scroll_bas = false
	elseif global_click["parametre"]["action"] == "select" then
		if global_edit_variable["type"] ~= nil then
			if global_edit_variable["type"] == "select" then
				global_variable[global_edit_variable["nom"]] = global_click["parametre"]["valeur"]
			end
		end
	elseif global_click["parametre"]["id"] == "select" then
		if global_edit_variable["type"] ~= nil then
			if global_edit_variable["type"] == "select" then
				global_variable[global_edit_variable["nom"]] = math.floor(global_click["parametre"]["valeur"])
			end
		end
	else
		global_edit_variable = {}
	end
	genere_term_affichage()
end