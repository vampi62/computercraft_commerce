function http_commande(http_req)
	local id_message_http = ""
	if not global_http_enable then -- tentative de reconnexion
		recup_http_config()
	end
	if global_http_enable then
		-- dans cette boucle if que les commandes retournant des listes
		if http_req == "http_offre" then
			id_message_http = http_get("listoffresboutique",true)
			if type(id_message_http) == "table" then
				return id_message_http
			end
		elseif http_req == "http_commande_client" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				id_message_http = http_get("listcommandes&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
				if type(id_message_http) == "table" then
					return id_message_http
				end
			end
		elseif http_req == "http_commande_commerce" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				id_message_http = http_get("listcommandes&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
				if type(id_message_http) == "table" then
					return id_message_http
				end
			end
		elseif http_req == "http_transaction" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				id_message_http = http_get("listusertransaction&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
				if type(id_message_http) == "table" then
					return id_message_http
				end
			end
		elseif http_req == "http_adresse" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				id_message_http = http_get("listuseradresse&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
				if type(id_message_http) == "table" then
					return id_message_http
				end
			end
		end


		-- dans cette boucle if que les commandes retournant un id de message
		if http_req == "inscription" then
			if global_variable["mdp"] ~= nil and global_variable["pseudo"] ~= nil and global_variable["confirm"] ~= nil and global_variable["email"] ~= nil then
				id_message_http = http_get("inscription&mdp="..global_variable["mdp"].."&pseudo="..global_variable["pseudo"].."&mdpconfirm="..global_variable["confirm"].."&email="..global_variable["email"],true)
			end
		elseif http_req == "deconnexion" then
			global_session = {pseudo="", mdp="", compte=0, email="", defautadresse={nom="",type="",coo="",description=""}, nbr_offre=0, role="", last_login=""}
			save_table_file(global_config_session, textutils.serialize(global_session), "global_session")
		elseif http_req == "connexion" then
			if global_variable["mdp"] ~= nil and global_variable["pseudo"] ~= nil then
				id_message_http = http_get("listuserdata&mdp="..global_variable["mdp"].."&pseudo="..global_variable["pseudo"],true)
				if type(id_message_http) == "table" then
					global_session = id_message_http
					global_session["mdp"] = global_variable["mdp"]
					save_table_file(global_config_session, textutils.serialize(global_session), "global_session")
					id_message_http = ""
				end
			end
		elseif http_req == "mdpoublie" then
			if global_variable["pseudo"] ~= nil and global_variable["email"] ~= nil then
				id_message_http = http_get("changemdpmail&pseudo="..global_variable["pseudo"].."&email="..global_variable["email"],true)
			end
		elseif http_req == "codemail" then
			if global_variable["codemail"] ~= nil and global_variable["pseudo"] ~= nil then
				id_message_http = http_get("recuperationmailmdp&token="..global_variable["codemail"].."&pseudo="..global_variable["pseudo"],true)
			end
		elseif http_req == "changemdp" then
			if global_variable["ancienmdp"] ~= nil and global_variable["pseudo"] ~= nil and global_variable["confirm"] ~= nil and global_variable["mdp"] ~= nil then
				id_message_http = http_get("updatemdp&mdp="..global_variable["ancienmdp"].."&pseudo="..global_session["pseudo"].."&mdpconfirm="..global_variable["confirm"].."&mdpnouveau="..global_variable["mdp"],true)
			end
		elseif http_req == "changemail" then
			if global_variable["mdp"] ~= nil and global_variable["pseudo"] ~= nil and global_variable["email"] ~= nil then
				id_message_http = http_get("updatemail&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&email="..global_variable["email"],true)
			end
		end
		if id_message_http ~= "" then
			global_message = convert_id_message(id_message_http)
		end
	end
end
function convert_id_message(message)
	local convert_message = ""
	if type(message) == "table" then
		for j=1, #message do
			if message[j] > 1 then
				convert_message = global_http_error_message["message_error"][message[j]]
				break
			end
		end
		if convert_message == "" then
			convert_message = global_http_error_message["message_error"][1]
		end
	else
		convert_message = global_http_error_message["message_error"][tonumber(message)]
	end
	return convert_message
end