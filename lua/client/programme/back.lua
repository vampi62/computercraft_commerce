function back()
	local ancien_global_scroll = 0
	local ancien_global_time = -1 -- -1 pour generer l'affichage du demarrage
	global_gestion_var = {type="page",nom="menu",variable="",nav={}}
	while true do
		sleep(0.3)
		if (global_scroll ~= ancien_global_scroll) or (global_time["min"] ~= ancien_global_time["min"]) or (global_click ~= "") or (global_key ~= "") then
			-- si input ou changement temps alors refresh affichage
			if global_click ~= "" then
				click_change_gestion()
				global_click = ""
				global_value = ""
			end
			if global_key ~= "" then
				key_change_gestion()
				global_key = ""
				global_maint_key = ""
			end
			if global_scroll ~= ancien_global_scroll then
				scroll_change_gestion()
				ancien_global_scroll = global_scroll
			end
			if global_time["min"] ~= ancien_global_time["min"] then
				time_change_gestion()
				ancien_global_time["min"] = global_time["min"]
			end
			
		end
	end
end
table.insert(global_gestion_var["nav"],"page")
table.remove(global_gestion_var["nav"],#global_gestion_var["nav"])
function click_change_gestion()
	if global_click == "page_login" then
		global_page_visible = "page_login"
	end
	if global_click == "page_mes_offres" then
		global_page_visible = "page_login"
	end
	if global_click == "page_mes_commandes" then
		global_page_visible = "page_login"
	end
	if global_click == "page_mes_transactions" then
		global_page_visible = "page_login"
	end
	if global_click == "page_offres" then
		global_page_visible = "page_login"
	end
	if global_click == "page_commandes" then
		global_page_visible = "page_login"
	end
	if global_click == "page_transactions" then
		global_page_visible = "page_login"
	end
	if global_click == "page_menu_admin" then
		global_page_visible = "page_login"
	end
	if global_click == "page_menu_config" then
		global_page_visible = "page_login"
	end
	if global_click == "page_menu" then
		global_page_visible = "page_login"
	end
	if global_click == "page_adresse" then
		global_page_visible = "page_login"
	end
	if global_click == "page_mise_a_jour" then
		global_page_visible = "page_login"
	end
	if global_click == "page_info" then
		global_page_visible = "page_login"
	end
	if global_click == "page_panier" then
		global_page_visible = "page_login"
	end
	if global_click == "page_filtres" then
		global_page_visible = "page_login"
	end
	if global_click == "page_plus_para" then
		global_page_visible = "page_login"
	end
	if global_click == "page_message_http" then
		global_page_visible = "page_login"
	end


	if global_click == "mise_a_jour" then
		global_page_visible = "page_login"
	end
	if global_click == "edit_config" then
		global_page_visible = "page_login"
	end
	if global_click == "reboot" then
		global_page_visible = "page_login"
	end
	if global_click == "shutdown" then
		global_page_visible = "page_login"
	end

end
function key_change_gestion()

end
function scroll_change_gestion()

end
function time_change_gestion()

end