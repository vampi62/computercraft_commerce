function genere_term_affichage()
	global_term_objet_select = {}
	global_term_objet_write = {} 
	if global_page_visible > 0 then
		page_nav()
		if global_page_visible == 10 then
			page_menu()
		elseif global_page_visible == 20 then
			page_session()
		elseif global_page_visible == 21 then
			page_session()
		elseif global_page_visible == 22 then
			page_session()
		elseif global_page_visible == 23 then
			page_session()
		elseif global_page_visible == 25 then
			page_session()
		elseif global_page_visible == 26 then
			page_session()
		elseif global_page_visible == 30 then
			page_offre_client()
		elseif global_page_visible == 31 then
			page_panier()
		elseif global_page_visible == 33 then
			page_plus_info_offre()
		elseif global_page_visible == 50 then
			page_commande_client()
		elseif global_page_visible == 53 then
			page_plus_info_commande()
		elseif global_page_visible == 54 then
			page_litige_commande()
		elseif global_page_visible == 60 then
			page_transaction_client()
		elseif global_page_visible == 63 then
			page_plus_info_transaction()
		elseif global_page_visible == 64 then
			page_litige_transaction()
		elseif global_page_visible == 90 then
			page_adresse()
		elseif global_page_visible == 91 then
			page_edit_adresse()
		elseif global_page_visible == 93 then
			page_plus_info_adresse()
		elseif global_page_visible == 101 then
			page_filtre()
		elseif global_page_visible == 130 then
			page_offre_commerce()
		elseif global_page_visible == 133 then
			page_plus_info_offre()
		elseif global_page_visible == 150 then
			page_commande_commerce()
		elseif global_page_visible == 153 then
			page_plus_info_commande()
		elseif global_page_visible == 154 then
			page_litige_commande()
		elseif global_page_visible == 160 then
			page_transaction_commerce()
		elseif global_page_visible == 163 then
			page_plus_info_transaction()
		elseif global_page_visible == 164 then
			page_litige_transaction()
		elseif global_page_visible == 200 then
			page_login_pc()
		elseif global_page_visible == 201 then
			page_login_pc()
		elseif global_page_visible == 202 then
			page_menu_config()
		elseif global_page_visible == 203 then
			page_mise_a_jour()
		elseif global_page_visible == 204 then
			page_info()
		elseif global_page_visible == 205 then
			page_edit_config()
		end
	else
		page_login_pc()
	end
	global_refresh_term = true
end