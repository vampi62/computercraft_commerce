function click_change_gestion()
	if global_value_click["action"] == "page" then
		changementpage(global_value_click["id"])
		if global_value_click["value"] ~= nil then
			global_variable["num_champ"] = global_value_click["value"]
		end
		if global_value_click["exe"] ~= nil then
			if global_value_click["exe"] ~= "" then
			-- commande a executer lors d'un changement de page
				if not global_http_enable then -- tentative de reconnexion
					recup_http_config()
				end
				if global_http_enable then
					-- uniquement les commandes qui demande un acces http ou utiliser les valeur de la table "global_http_error_message"
					if global_value_click["exe"] == "http_offre" then
						if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
							id_message_http = http_get("listoffresboutique",true)
							if type(id_message_http) == "table" then
								global_liste_offre = id_message_http
								id_message_http = nil
							end
						end
					elseif global_value_click["exe"] == "http_commande" then
						if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
							id_message_http = http_get("listcommandes&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
							if type(id_message_http) == "table" then
								global_liste_commande = id_message_http
								id_message_http = nil
							end
						end
					elseif global_value_click["exe"] == "http_transaction" then
						if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
							id_message_http = http_get("listusertransaction&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
							if type(id_message_http) == "table" then
								global_liste_transaction = id_message_http
								id_message_http = nil
							end
						end
					elseif global_value_click["exe"] == "http_adresse" then
						if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
							id_message_http = http_get("listuseradresse&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
							if type(id_message_http) == "table" then
								global_liste_adresse = id_message_http
								id_message_http = nil
							end
						end
					end
				end
			end
		end
	end
	if global_value_click["action"] == "action" then
		if global_value_click["id"] == "reboot" then
			-- a realiser -- animation
			os.reboot()
		elseif global_value_click["id"] == "shutdown" then
			-- a realiser -- animation
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
		elseif global_value_click["id"] == "maj" then
			save_var_file("config/update.lua", global_systeme_version .. "-" .. global_new_version[global_systeme_nom], "update")
			-- a realiser -- animation
			os.reboot()
		else
			-- uniquement les commandes qui demande un acces http ou utiliser les valeur de la table "global_http_error_message"
			if not global_http_enable then -- tentative de reconnexion
				recup_http_config()
			end
			if global_http_enable then
				if global_value_click["id"] == "inscription" then
					if global_variable["mdp"] ~= nil and global_variable["pseudo"] ~= nil and global_variable["confirm"] ~= nil and global_variable["email"] ~= nil then
						id_message_http = http_get("inscription&mdp="..global_variable["mdp"].."&pseudo="..global_variable["pseudo"].."&mdpconfirm="..global_variable["confirm"].."&email="..global_variable["email"],true)
					end
				elseif global_value_click["id"] == "deconnexion" then
					global_session = {pseudo="", mdp="", compte=0, email="", defautadresse={nom="",type="",coo="",description=""}, nbr_offre=0, role="", last_login=""}
					save_table_file(global_config_session, textutils.serialize(global_session), "global_session")
				elseif global_value_click["id"] == "connexion" then
					if global_variable["mdp"] ~= nil and global_variable["pseudo"] ~= nil then
						id_message_http = http_get("listuserdata&mdp="..global_variable["mdp"].."&pseudo="..global_variable["pseudo"],true)
						if type(id_message_http) == "table" then
							global_session = id_message_http
							global_session["mdp"] = global_variable["mdp"]
							save_table_file(global_config_session, textutils.serialize(global_session), "global_session")
							id_message_http = nil
						end
					end
				elseif global_value_click["id"] == "mdpoublie" then
					if global_variable["pseudo"] ~= nil and global_variable["email"] ~= nil then
						id_message_http = http_get("changemdpmail&pseudo="..global_variable["pseudo"].."&email="..global_variable["email"],true)
					end
				elseif global_value_click["id"] == "codemail" then
					if global_variable["codemail"] ~= nil and global_variable["pseudo"] ~= nil then
						id_message_http = http_get("recuperationmailmdp&token="..global_variable["codemail"].."&pseudo="..global_variable["pseudo"],true)
					end
				elseif global_value_click["id"] == "changemdp" then
					if global_variable["ancienmdp"] ~= nil and global_variable["pseudo"] ~= nil and global_variable["confirm"] ~= nil and global_variable["mdp"] ~= nil then
						id_message_http = http_get("updatemdp&mdp="..global_variable["ancienmdp"].."&pseudo="..global_session["pseudo"].."&mdpconfirm="..global_variable["confirm"].."&mdpnouveau="..global_variable["mdp"],true)
					end
				elseif global_value_click["id"] == "changemail" then
					if global_variable["mdp"] ~= nil and global_variable["pseudo"] ~= nil and global_variable["email"] ~= nil then
						id_message_http = http_get("updatemail&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&email="..global_variable["email"],true)
					end
				elseif global_value_click["id"] == "achatoffre" then
					if global_variable["mdp"] ~= nil and global_variable["pseudo"] ~= nil and global_variable["confirm"] ~= nil and global_variable["email"] ~= nil then
						-- a realiser --
					end
				end
			end
		end
	end
	if global_value_click["action"] == "variable" then
		global_edit_variable = {nom = global_value_click["id"], type = global_value_click["value"]}
	else
		if global_edit_variable["nom"] ~= nil then
			global_edit_variable = {}
		end
	end
	if id_message_http ~= nil then
		if type(id_message_http) == "table" then
			global_message = ""
			for j=1, #id_message_http do
				if id_message_http[j] > 1 then
					global_message = global_http_error_message["message_error"][id_message_http[j]]
					break
				end
			end
			if global_message == "" then
				global_message = global_http_error_message["message_error"][1]
			end
		else
			global_message = global_http_error_message["message_error"][tonumber(id_message_http)]
		end
	end
	id_message_http = nil

	genere_term_affichage()
end