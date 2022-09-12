function click_change_gestion()
	if global_value_click["action"] == "page" then
		changementpage(global_value_click["id"])
	end
	if global_value_click["action"] == "action" then
		if global_value_click["id"] == "reboot" then
			-- a realiser -- animation
			os.reboot()
		elseif global_value_click["id"] == "shutdown" then
			-- a realiser -- animation
			os.shutdown()
		elseif global_value_click["id"] == "edit_config" then
			if fs.exists(global_config_http..".back") then
				fs.delete(global_config_http..".back")
			end
			fs.copy(global_config_http,global_config_http..".back")
			local etat, error_mes = pcall(shell.run(global_config_http..".back"))
			if not etat then
				global_message = global_local_error_message[20]
			else
				
				-- a realiser -- test http
				-- a realiser -- test toutes les variables du fichier
				
				fs.delete(global_config_http)
				fs.move(global_config_http..".back",global_config_http)
				global_message = global_local_error_message[12]
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
			save_var_file("config/update", global_systeme_version .. "-" .. global_new_version[global_systeme_nom], "update")
			-- a realiser -- animation
			os.reboot()
		elseif global_value_click["id"] == "inscription" then
			id_message_http = http_get("inscription&mdp="..global_variable["mdp"].."&pseudo="..global_variable["pseudo"].."&mdpconfirm="..global_variable["confirm"].."&email="..global_variable["email"],true)
		elseif global_value_click["id"] == "deconnexion" then
			global_session = {pseudo="", mdp="", compte=0, email="", defautadresse={nom="",type="",coo="",description=""}, nbr_offre=0, role="", last_login=""}
			save_table_file(global_config_session, textutils.serialize(global_session), "global_session")
		elseif global_value_click["id"] == "connexion" then
			id_message_http = http_get("listuserdata&mdp="..global_variable["mdp"].."&pseudo="..global_variable["pseudo"],true)
			if type(id_message_http) == "table" then
				global_session = id_message_http
				global_session["mdp"] = global_variable["mdp"]
				save_table_file(global_config_session, textutils.serialize(global_session), "global_session")
				id_message_http = nil
			end
		elseif global_value_click["id"] == "mdpoublie" then
			id_message_http = http_get("changemdpmail&pseudo="..global_variable["pseudo"].."&email="..global_variable["email"],true)
		elseif global_value_click["id"] == "codemail" then
			id_message_http = http_get("recuperationmailmdp&token="..global_variable["codemail"].."&pseudo="..global_variable["pseudo"],true)
		elseif global_value_click["id"] == "changemdp" then
			id_message_http = http_get("updatemdp&mdp="..global_variable["ancienmdp"].."&pseudo="..global_session["pseudo"].."&mdpconfirm="..global_variable["confirm"].."&mdpnouveau="..global_variable["mdp"],true)
		elseif global_value_click["id"] == "changemail" then
			id_message_http = http_get("updatemail&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&email="..global_variable["email"],true)
		elseif global_value_click["id"] == "achatoffre" then
			-- a realiser --
		end


		if id_message_http ~= nil then
			if type(id_message_http) == "table" then
				for j=1, #id_message_http do
					if id_message_http[j] > 1 then
						global_message = global_http_error_message["message_error"][id_message_http[j]]
						break
					end
				end
				global_message = global_http_error_message["message_error"][1]
			else
				global_message = global_http_error_message["message_error"][tonumber(id_message_http)]
			end
		end
		id_message_http = nil
	end
	if global_value_click["action"] == "variable" then
		if global_value_click["id"] == "pseudo" then
			local_vartype = "text"
		elseif global_value_click["id"] == "mdp" then
			local_vartype = "code"
		elseif global_value_click["id"] == "confirm" then
			local_vartype = "code"
		elseif global_value_click["id"] == "email" then
			local_vartype = "text"
		elseif global_value_click["id"] == "codemail" then
			local_vartype = "text"
		elseif global_value_click["id"] == "ancienmdp" then
			local_vartype = "code"
		elseif global_value_click["id"] == "nbroffre" then
			local_vartype = "int"
		end
		global_edit_variable = {nom = global_value_click["id"], type = local_vartype}
	else
		if global_edit_variable["nom"] ~= nil then
			global_edit_variable = {}
		end
	end
	genere_term_affichage()
end