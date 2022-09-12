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