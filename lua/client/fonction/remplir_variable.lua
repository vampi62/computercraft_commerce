function remplir_variable(variable_a_remplir,variable_a_coller)
    for j=1, #variable_a_remplir do
        if global_variable[variable_a_remplir[j]] == nil then
            global_variable[variable_a_remplir[j]] = variable_a_coller[j]
        end
    end
end