function key_change_gestion()
	if global_edit_variable["nom"] ~= nil then
		if global_variable[global_edit_variable["nom"]] == nil then
			global_variable[global_edit_variable["nom"]] = ""
			if global_edit_variable["type"] == "code" then
				global_variable[global_edit_variable["nom"].."_len"] = ""
			end
		end
		if global_clavier == "backspace" or global_clavier == "delete" then
			global_variable[global_edit_variable["nom"]] = string.sub(global_variable[global_edit_variable["nom"]],1,#global_variable[global_edit_variable["nom"]]-1)
			if global_edit_variable["type"] == "code" then
				global_variable[global_edit_variable["nom"].."_len"] = string.sub(global_variable[global_edit_variable["nom"].."_len"],1,#global_variable[global_edit_variable["nom"].."_len"]-1)
			end
		elseif global_clavier == "enter" then
			global_edit_variable = {}
		elseif global_clavier == "space" then
			global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. " "
			if global_edit_variable["type"] == "code" then
				global_variable[global_edit_variable["nom"].."_len"] = global_variable[global_edit_variable["nom"].."_len"] .. "*"
			end
		else
			if string.len(global_clavier) == 1 then
				if global_edit_variable["type"] ~= "int" and global_edit_variable["type"] ~= "float" then
					if global_clavier_maj["lock"] or global_clavier_maj["shift"] then
						global_clavier = string.upper(global_clavier)
						global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. global_clavier
					else
						global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. global_clavier
					end
					if global_edit_variable["type"] == "code" then
						global_variable[global_edit_variable["nom"].."_len"] = global_variable[global_edit_variable["nom"].."_len"] .. "*"
					end
				end
			else
				local key_convert = convert_key_number_altgr(global_clavier)
				if key_convert ~= "" then
					if global_edit_variable["type"] == "int" or global_edit_variable["type"] == "float" then
						if tonumber(key_convert) ~= nil then
							global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. key_convert
						end
					else
						global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. key_convert
					end
					if global_edit_variable["type"] == "code" then
						global_variable[global_edit_variable["nom"].."_len"] = global_variable[global_edit_variable["nom"].."_len"] .. "*"
					end
				end
			end
		end
	end
	genere_term_affichage()
end