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
		elseif global_page_visible == 205 then
			shell.run("page/edit_config.lua")
		end
	else
		shell.run("page/login_pc.lua")
	end
	global_refresh_term = true
end