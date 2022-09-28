function page_filtre()
    local texte_info = {
		"coo        :",
		"description:"
	}
	local texte_variable = {
		"",
		""
	}
	local variable_nom = {
		"coo",
		"description"
	}
	local variable_type = {
		"text",
		"text"
	}
	creation_variable(variable_nom,texte_variable)
	print_tableau_plus_info_scroll(31,texte_variable,texte_info,variable_nom,variable_type)
	for j=1, #variable_nom do
		if variable_type[j] ~= nil and variable_type[j] ~= "" then
			texte_variable[j] = global_variable[variable_nom[j]]
		end
	end
	genere_scroll_barre(texte_variable,31,global_scroll,global_min_y_page,global_max_y_page)

    local texte_info = {
		"coo        :",
		"description:"
	}
	local texte_variable = {
		"",
		""
	}
	local variable_nom = {
		"coo",
		"description"
	}
	local variable_type = {
		"text",
		"text"
	}
	creation_variable(variable_nom,texte_variable)
	print_tableau_plus_info_scroll(31,texte_variable,texte_info,variable_nom,variable_type)
	for j=1, #variable_nom do
		if variable_type[j] ~= nil and variable_type[j] ~= "" then
			texte_variable[j] = global_variable[variable_nom[j]]
		end
	end
	genere_scroll_barre(texte_variable,31,global_scroll,global_min_y_page,global_max_y_page)
end