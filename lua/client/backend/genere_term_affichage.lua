function genere_term_affichage()
	global_term_objet_select = {}
	global_term_objet_write = {} 
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	if global_page_visible > 0 then
		page_nav()
		if global_page_visible == 10 then
			page_menu()
		elseif global_page_visible == 20 then
			page_session_menu()
		elseif global_page_visible == 21 then
			page_session_inscription()
		elseif global_page_visible == 22 then
			page_session_mdp_oublie()
		elseif global_page_visible == 23 then
			page_session_code_mail()
		elseif global_page_visible == 25 then
			page_session_change_email()
		elseif global_page_visible == 26 then
			page_session_change_mdp()
		elseif global_page_visible == 30 then
			page_tableau_offre_client()
		elseif global_page_visible == 33 then
			page_plus_info_offre_client()
		elseif global_page_visible == 40 then
			page_tableau_panier()
		elseif global_page_visible == 43 then
			page_plus_info_offre_client()
		elseif global_page_visible == 50 then
			page_tableau_commande_client()
		elseif global_page_visible == 53 then
			page_plus_info_commande()
		elseif global_page_visible == 54 then
			page_litige_commande()
		elseif global_page_visible == 60 then
			page_tableau_transaction()
		elseif global_page_visible == 63 then
			page_plus_info_transaction()
		elseif global_page_visible == 90 then
			page_tableau_adresse()
		elseif global_page_visible == 91 then
			page_plus_info_adresse_new()
		elseif global_page_visible == 93 then
			page_plus_info_adresse()
		elseif global_page_visible == 101 then
			page_filtre()
		elseif global_page_visible == 130 then
			page_tableau_offre_commerce()
		elseif global_page_visible == 133 then
			page_plus_info_offre_commerce()
		elseif global_page_visible == 150 then
			page_tableau_commande_commerce()
		elseif global_page_visible == 153 then
			page_plus_info_commande()
		elseif global_page_visible == 154 then
			page_litige_commande()
		elseif global_page_visible == 200 then
			page_login_pc_get_mdp()
		elseif global_page_visible == 201 then
			page_login_pc_reset_mdp()
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
		page_login_pc_set_mdp()
	end
	genere_select_frame()
	global_refresh_term = true
end