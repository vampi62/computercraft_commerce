function import_variable(variable_nom,variable_type)
    local texte_variable = {}
    for j=1, #variable_nom do
		if variable_type[j] ~= nil and variable_type[j] ~= "" then
			texte_variable[j] = global_variable[variable_nom[j]]
		end
	end
    return texte_variable
end