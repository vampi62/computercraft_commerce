function http_commande(http_req)
	local id_message_http = ""
	if not global_http_enable then -- tentative de reconnexion
		recup_http_config()
	end
	if global_http_enable then
		local liste = ""
		-- dans cette boucle if que les commandes retournant des listes
		if http_req == "http_offre" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("listoffresboutique&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
				else
					id_message_http = http_get("listoffresboutique",true)
				end
			else
				id_message_http = http_get("listoffresboutique",true)
			end
			if type(id_message_http) == "table" then
				id_message_http["date_sync"] = os.time()*50+120
				global_liste["offre"] = id_message_http
				id_message_http = ""
			end
		elseif http_req == "http_commande_client" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("listusercommande&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
					if type(id_message_http) == "table" then
						id_message_http["date_sync"] = os.time()*50+global_local_config["resync_liste"]
						global_liste["commande_client"] = id_message_http
						id_message_http = ""
					end
				end
			end
		elseif http_req == "http_commande_commerce" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("listcommandes&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
					if type(id_message_http) == "table" then
						id_message_http["date_sync"] = os.time()*50+global_local_config["resync_liste"]
						global_liste["commande_commerce"] = id_message_http
						id_message_http = ""
					end
				end
			end
		elseif http_req == "http_transaction" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("listusertransaction&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
					if type(id_message_http) == "table" then
						id_message_http["date_sync"] = os.time()*50+global_local_config["resync_liste"]
						global_liste["transaction"] = id_message_http
						id_message_http = ""
					end
				end
			end
		elseif http_req == "http_adresse" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("listuseradresse&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
					if type(id_message_http) == "table" then
						id_message_http["date_sync"] = os.time()*50+global_local_config["resync_liste"]
						global_liste["adresse"] = id_message_http
						id_message_http = ""
					end
				end
			end
		elseif http_req == "http_login" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("listuserdata&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
					if type(id_message_http) == "table" then
						local mdp_session = global_session["mdp"]
						global_session = id_message_http
						global_session["date_sync"] = 0
						global_session["mdp"] = mdp_session
						id_message_http = ""
						mdp_session = nil
					end
				end
			end
		end


		-- dans cette boucle if que les commandes retournant un id de message
		if http_req == "inscription" then
			if global_variable["mdp"] ~= nil and global_variable["pseudo"] ~= nil and global_variable["confirm"] ~= nil and global_variable["email"] ~= nil then
				if global_variable["mdp"] ~= "" and global_variable["pseudo"] ~= "" and global_variable["confirm"] ~= "" and global_variable["email"] ~= ""  then
					id_message_http = http_get("inscription&mdp="..global_variable["mdp"].."&pseudo="..global_variable["pseudo"].."&mdpconfirm="..global_variable["confirm"].."&email="..global_variable["email"],true)
				end
			end
		elseif http_req == "deconnexion" then
			global_session = {pseudo="", mdp="", compte=0, email="", defautadresse={nom="",type="",coo="",description=""}, nbr_offre=0, role="", last_login=""}
			save_table_file(global_config_session, textutils.serialize(global_session), "global_session")
		elseif http_req == "connexion" then
			if global_variable["mdp"] ~= nil and global_variable["pseudo"] ~= nil then
				if global_variable["mdp"] ~= "" and global_variable["pseudo"] ~= "" then
					id_message_http = http_get("listuserdata&mdp="..global_variable["mdp"].."&pseudo="..global_variable["pseudo"],true)
					if type(id_message_http) == "table" then
						global_session = id_message_http
						global_session["mdp"] = global_variable["mdp"]
						save_table_file(global_config_session, textutils.serialize(global_session), "global_session")
						id_message_http = ""
						if global_panier[global_session["pseudo"]] == nil then
							global_panier[global_session["pseudo"]] = {}
						end
					end
				end
			end
		elseif http_req == "mdpoublie" then
			if global_variable["pseudo"] ~= nil and global_variable["email"] ~= nil then
				if global_variable["pseudo"] ~= "" and global_variable["email"] ~= "" then
					id_message_http = http_get("changemdpmail&pseudo="..global_variable["pseudo"].."&email="..global_variable["email"],true)
				end
			end
		elseif http_req == "codemail" then
			if global_variable["codemail"] ~= nil and global_variable["pseudo"] ~= nil then
				if global_variable["codemail"] ~= "" and global_variable["pseudo"] ~= "" then
					id_message_http = http_get("recuperationmailmdp&token="..global_variable["codemail"].."&pseudo="..global_variable["pseudo"],true)
				end
			end
		elseif http_req == "changemdp" then
			if global_variable["ancienmdp"] ~= nil and global_session["pseudo"] ~= nil and global_variable["confirm"] ~= nil and global_variable["mdp"] ~= nil then
				if global_variable["ancienmdp"] ~= "" and global_session["pseudo"] ~= "" and global_variable["confirm"] ~= "" and global_variable["mdp"] ~= "" then
					id_message_http = http_get("updatemdp&mdp="..global_variable["ancienmdp"].."&pseudo="..global_session["pseudo"].."&mdpconfirm="..global_variable["confirm"].."&mdpnouveau="..global_variable["mdp"],true)
				end
			end
		elseif http_req == "changemail" then
			if global_variable["mdp"] ~= nil and global_session["pseudo"] ~= nil and global_variable["email"] ~= nil then
				if global_variable["mdp"] ~= "" and global_session["pseudo"] ~= "" and global_variable["email"] ~= "" then
					id_message_http = http_get("updatemail&mdp="..global_variable["mdp"].."&pseudo="..global_session["pseudo"].."&email="..global_variable["email"],true)
				end
			end
		elseif http_req == "http_commande_offre" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("achat&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&id="..global_variable["id"].."&quantite="..global_variable["quant"],true)
				end
			end
		elseif http_req == "http_update_offre" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					tval = "&nomadresse="..global_variable["adresse"]
					tval = tval.."&type="..global_variable["type"].."&livraison="..global_variable["livraison"].."&id="..global_variable["id"].."&prix="..global_variable["prix"].."&nbr_dispo="..global_variable["nbr_dispo"].."&nom="..global_variable["nom"].."&description="..global_variable["description"]
					id_message_http = http_get("updateoffreboutique&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"]..tval,true)
					liste = "offre"
				end
			end
		elseif http_req == "ad_panier" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil and tonumber(global_variable["quant"]) ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					if global_panier[global_session["pseudo"]] == nil then
						global_panier[global_session["pseudo"]] = {}
					end
					if tonumber(global_variable["quant"]) > 0 then
						local panier_trouver = false
						for j=1, #global_panier[global_session["pseudo"]] do
							if global_panier[global_session["pseudo"]][j]["id"] == global_variable["id"] then
								global_panier[global_session["pseudo"]][j]["quant"] = global_panier[global_session["pseudo"]][j]["quant"] + global_variable["quant"]
								panier_trouver = true
								break
							end
						end
						if not panier_trouver then
							table.insert(global_panier[global_session["pseudo"]],{quant=global_variable["quant"],id=global_variable["id"],nom=global_variable["nom"]})
						end
						save_table_file(global_config_panier, textutils.serialize(global_panier), "global_panier")
						global_message = global_local_error_message[30]
					end
				end
			end
		elseif http_req == "save_panier" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil and tonumber(global_variable["quant"]) ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					if global_panier[global_session["pseudo"]] == nil then
						global_panier[global_session["pseudo"]] = {}
					end
					if tonumber(global_variable["quant"]) > 0 then
						local panier_trouver = false
						for j=1, #global_panier[global_session["pseudo"]] do
							if global_panier[global_session["pseudo"]][j]["id"] == global_variable["id"] then
								global_panier[global_session["pseudo"]][j]["quant"] = global_variable["quant"]
								panier_trouver = true
								break
							end
						end
						if not panier_trouver then
							table.insert(global_panier[global_session["pseudo"]],{quant=global_variable["quant"],id=global_variable["id"],nom=global_variable["nom"]})
						end
						save_table_file(global_config_panier, textutils.serialize(global_panier), "global_panier")
					end
				end
			end
			changementpage(-1)
			if global_click["parametre"]["filtre"] ~= nil then
				for k, v in pairs(global_click["parametre"]["filtre"]) do
					global_filtre[k] = global_click["parametre"]["filtre"][k]
				end
			end
		elseif http_req == "del_panier" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					if global_panier[global_session["pseudo"]] == nil then
						global_panier[global_session["pseudo"]] = {}
					end
					for j=1, #global_panier[global_session["pseudo"]] do
						if global_panier[global_session["pseudo"]][j]["id"] == global_variable["id"] then
							table.remove(global_panier[global_session["pseudo"]],j)
							break
						end
					end
					save_table_file(global_config_panier, textutils.serialize(global_panier), "global_panier")
					global_message = global_local_error_message[31]
				end
			end
		elseif http_req == "http_commande_offre_panier" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					if global_panier[global_session["pseudo"]] == nil then
						global_panier[global_session["pseudo"]] = {}
					end
					for j=1, #global_panier[global_session["pseudo"]] do
						if global_panier[global_session["pseudo"]][j]["id"] == global_variable["id"] then
							table.remove(global_panier[global_session["pseudo"]],j)
							break
						end
					end
					id_message_http = http_get("achat&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&id="..global_variable["id"].."&quantite="..global_variable["quant"],true)
					save_table_file(global_config_panier, textutils.serialize(global_panier), "global_panier")
				end
			end
		elseif http_req == "achat_panier" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					if global_panier[global_session["pseudo"]] == nil then
						global_panier[global_session["pseudo"]] = {}
					end
					if global_variable["prix_panier"] <= tonumber(global_session["compte"]) then
						for j=1, #global_panier[global_session["pseudo"]] do
							id_message_http = http_get("achat&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&id="..global_panier[global_session["pseudo"]][j]["id"].."&quantite="..global_panier[global_session["pseudo"]][j]["quant"],true)
							if id_message_http == "1" then
								table.remove(global_panier[global_session["pseudo"]],j)
								j=j-1
							end
						end
						if #global_panier[global_session["pseudo"]] > 0 then
							global_message = global_local_error_message[33]
						else
							global_message = global_local_error_message[34]
						end
						save_table_file(global_config_panier, textutils.serialize(global_panier), "global_panier")
					else
						global_message = global_local_error_message[32]
					end
				end
			end
		elseif http_req == "http_add_adr" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("addadresse&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&nom="..global_variable["nom"].."&type="..global_variable["type_adresse"].."&coo="..global_variable["coo"].."&description="..global_variable["description"],true)
					liste = "adresse"
				end
			end
		elseif http_req == "http_suppr_adr" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("deleteadresse&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&nom="..global_variable["id"],true)
					liste = "adresse"
				end
			end
		elseif http_req == "http_update_adr" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					tval = ""
					if global_variable["nom"] ~= global_variable["id"] then
						tval = tval.."&nouveaunom="..global_variable["nom"]
					end
					if global_variable["type_adresse"] ~= global_variable["ancientype"] then
						tval = tval.."&type="..global_variable["type_adresse"]
					end
					id_message_http = http_get("updateadresse&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&nom="..global_variable["id"]..tval.."&coo="..global_variable["coo"].."&description="..global_variable["description"],true)
					liste = "adresse"
					http_commande("http_login")
				end
			end
		elseif http_req == "http_defaut_adr" then
			if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
				if global_session["mdp"] ~= "" and global_session["pseudo"] ~= "" then
					id_message_http = http_get("updateadressedefaut&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"].."&nom="..global_variable["id"],true)
					if id_message_http == 1 then
						http_commande("http_login")
					end
				end
			end
		end
		if id_message_http ~= "" then
			global_message = convert_id_message(id_message_http)
			if liste ~= "" and ((id_message_http == "1") or (type(id_message_http) == "table")) then
				resync_liste(liste,true)
			end
		end
	end
end
function convert_id_message(message)
	local convert_message = ""
	if type(message) == "table" then
		for j=1, #message do
			if tonumber(message[j]) > 1 then
				convert_message = global_http_error_message["message_error"][tonumber(message[j])]
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