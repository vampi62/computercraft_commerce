function back()
	local ancien_global_scroll = 0
	local ancien_global_ntp = -1 -- -1 pour generer l'affichage du demarrage
	local horloge_back = 0.05
	while true do
		sleep(horloge_back)
		if (global_scroll ~= ancien_global_scroll) or (global_ntp["minute"] ~= ancien_global_ntp) or (global_value_click["action"] ~= nil) or (global_clavier ~= "") then
			-- si input ou changement temps alors refresh affichage
			if global_value_click["action"] ~= nil then
				click_change_gestion()
				global_value_click = {}
			end
			if global_clavier ~= "" then
				key_change_gestion()
				global_clavier = ""
				global_maint_key = ""
			end
			if global_scroll ~= ancien_global_scroll then
				scroll_change_gestion(ancien_global_scroll)
				ancien_global_scroll = global_scroll
			end
			if global_ntp["minute"] ~= ancien_global_ntp then
				time_change_gestion()
				ancien_global_ntp = global_ntp["minute"]
			end
		end
		if global_message ~= "" then
			global_compteur_tempo_message_http = global_compteur_tempo_message_http + horloge_back
			if global_compteur_tempo_message_http >= global_local_config["delay_seconde"] then
				global_message = ""
				global_compteur_tempo_message_http = 0
				genere_term_affichage()
			end
		end
	end
end
function changementpage(new_page)
	if new_page == -1 then
		global_page_visible = global_histo_nav[#global_histo_nav-1]
		table.remove(global_histo_nav,#global_histo_nav)
	else
		global_page_visible = new_page
		table.insert(global_histo_nav,new_page)
	end
	reinitbox()
end

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
			id_message_http = http_get("updatemdp&mdp="..global_variable["ancienmdp"].."&pseudo="..global_variable["pseudo"].."&mdpconfirm="..global_variable["confirm"].."&mdpnouveau="..global_variable["mdp"],true)
		elseif global_value_click["id"] == "changemail" then
			id_message_http = http_get("updatemail&mdp="..global_variable["mdp"].."&pseudo="..global_variable["pseudo"].."&email="..global_variable["email"],true)
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
function convertkey_number_altgr(numberkey)
	stringkey = ""
	if global_clavier_maj["altgr"] then
		if numberkey == "zero" then
			stringkey = "@"
		end
	else
		numbertab = {"0","1","2","3","4","5","6","7","8","9","-","+",".","?","/"}
		stringtab = {"zero","one","two","three","four","five","six","seven","eight","nine","leftBracket","equals","period","comma","slash"}
		for j=1, #numbertab do
			if numberkey == stringtab[j] then
				stringkey = numbertab[j]
				break
			end
		end
	end
	return stringkey
end
function key_change_gestion()
	if global_edit_variable["nom"] ~= nil then
		if global_clavier == "backspace" or global_clavier == "delete" then
			global_variable[global_edit_variable["nom"]] = string.sub(global_variable[global_edit_variable["nom"]],1,#global_variable[global_edit_variable["nom"]]-1)
			if global_edit_variable["nom"] == "mdp" or global_edit_variable["nom"] == "confirm" or global_edit_variable["nom"] == "ancienmdp" then
				global_variable[global_edit_variable["nom"].."_len"] = string.sub(global_variable[global_edit_variable["nom"].."_len"],1,#global_variable[global_edit_variable["nom"].."_len"]-1)
			end
		elseif global_clavier == "enter" then
			global_edit_variable = {}
		else
			if string.len(global_clavier) == 1 then
				if global_clavier_maj["lock"] or global_clavier_maj["shift"] then
					global_clavier = string.upper(global_clavier)
					global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. global_clavier
				else
					global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. global_clavier
				end
				if global_edit_variable["nom"] == "mdp" or global_edit_variable["nom"] == "confirm" or global_edit_variable["nom"] == "ancienmdp" then
					global_variable[global_edit_variable["nom"].."_len"] = global_variable[global_edit_variable["nom"].."_len"] .. "*"
				end
			else
				global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. convertkey_number_altgr(global_clavier)
				if global_edit_variable["nom"] == "mdp" or global_edit_variable["nom"] == "confirm" or global_edit_variable["nom"] == "ancienmdp" then
					if convertkey_number_altgr(global_clavier) ~= "" then
						global_variable[global_edit_variable["nom"].."_len"] = global_variable[global_edit_variable["nom"].."_len"] .. "*"
					end
				end
			end
		end
	end
	genere_term_affichage()
end
function scroll_change_gestion(ancien_scroll)
	if global_edit_variable["type"] ~= nil then
		if global_edit_variable["type"] == "int" and not true then -- a realiser -- a revoir
			local scroll_int = global_scroll - ancien_scroll
			global_scroll = 0
			local int_var = tonumber(global_variable[global_edit_variable["nom"]])
			local result_int = int_var + scroll_int
			if result_int <= 0 then
				result_int = 0
			else
				global_variable[global_edit_variable["nom"]] = tostring(result_int)
			end
		end
	end
	genere_term_affichage()
end
function time_change_gestion()
	genere_term_affichage()
end
function genere_term_affichage()
	global_term_objet_select = {}
	global_term_objet_write = {} 
	if global_page_visible > 0 then
		shell.run("page/nav.lua")
		if global_page_visible == 10 then
			shell.run("page/menu.lua")
		elseif global_page_visible == 20 then
			shell.run("page/session.lua")
		elseif global_page_visible == 21 then
			shell.run("page/session.lua")
		elseif global_page_visible == 22 then
			shell.run("page/session.lua")
		elseif global_page_visible == 23 then
			shell.run("page/session.lua")
		elseif global_page_visible == 25 then
			shell.run("page/session.lua")
		elseif global_page_visible == 26 then
			shell.run("page/session.lua")
		elseif global_page_visible == 27 then
			shell.run("page/session.lua")
		elseif global_page_visible == 30 then
			shell.run("page/offre_client.lua")
		elseif global_page_visible == 31 then
			shell.run("page/offre_client.lua")
		elseif global_page_visible == 33 then
			shell.run("page/plus_info_client.lua")
		elseif global_page_visible == 50 then
			shell.run("page/commande_client.lua")
		elseif global_page_visible == 53 then
			shell.run("page/plus_info_client.lua")
		elseif global_page_visible == 54 then
			shell.run("page/litige.lua")
		elseif global_page_visible == 60 then
			shell.run("page/transaction_client.lua")
		elseif global_page_visible == 63 then
			shell.run("page/plus_info_client.lua")
		elseif global_page_visible == 64 then
			shell.run("page/litige.lua")
		elseif global_page_visible == 90 then
			shell.run("page/adresse.lua")
		elseif global_page_visible == 91 then
			shell.run("page/edit_adresse.lua")
		elseif global_page_visible == 92 then
			shell.run("page/edit_adresse.lua")
		elseif global_page_visible == 101 then
			shell.run("page/filtre.lua")
		elseif global_page_visible == 102 then
			shell.run("page/filtre.lua")
		elseif global_page_visible == 103 then
			shell.run("page/filtre.lua")
		elseif global_page_visible == 104 then
			shell.run("page/filtre.lua")
		elseif global_page_visible == 130 then
			shell.run("page/offre_commerce.lua")
		elseif global_page_visible == 133 then
			shell.run("page/plus_info_commerce.lua")
		elseif global_page_visible == 150 then
			shell.run("page/commande_commerce.lua")
		elseif global_page_visible == 153 then
			shell.run("page/plus_info_commerce.lua")
		elseif global_page_visible == 160 then
			shell.run("page/transaction_commerce.lua")
		elseif global_page_visible == 163 then
			shell.run("page/plus_info_commerce.lua")
		elseif global_page_visible == 200 then
			shell.run("page/login_pc.lua")
		elseif global_page_visible == 201 then
			shell.run("page/login_pc.lua")
		elseif global_page_visible == 202 then
			shell.run("page/menu_config.lua")
		elseif global_page_visible == 203 then
			shell.run("page/mise_a_jour.lua")
		elseif global_page_visible == 204 then
			shell.run("page/info.lua")
		end
	else
		shell.run("page/login_pc.lua")
	end
	global_refresh_term = true
end