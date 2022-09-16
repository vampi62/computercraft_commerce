function scroll_change_gestion(ancien_scroll)
	if global_edit_variable["type"] ~= nil then
		if global_edit_variable["type"] == "int" or global_edit_variable["type"] == "float" then
			local scroll_int = global_scroll - ancien_scroll
			if global_edit_variable["type"] == "float" then
				scroll_int = scroll_int/10
			end
			global_scroll = 0
			local int_var = tonumber(global_variable[global_edit_variable["nom"]])
			local result_int = int_var + scroll_int
			if result_int <= 0 then
				result_int = 0
			end
			global_variable[global_edit_variable["nom"]] = tostring(result_int)
		end
	end
	genere_term_affichage()
end