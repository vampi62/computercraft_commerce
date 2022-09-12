function key_change_gestion()
	if global_edit_variable["nom"] ~= nil then
		if global_clavier == "backspace" or global_clavier == "delete" then
			global_variable[global_edit_variable["nom"]] = string.sub(global_variable[global_edit_variable["nom"]],1,#global_variable[global_edit_variable["nom"]]-1)
			if global_edit_variable["nom"] == "mdp" or global_edit_variable["nom"] == "confirm" or global_edit_variable["nom"] == "ancienmdp" then
				global_variable[global_edit_variable["nom"].."_len"] = string.sub(global_variable[global_edit_variable["nom"].."_len"],1,#global_variable[global_edit_variable["nom"].."_len"]-1)
			end
		elseif global_clavier == "enter" then
			global_edit_variable = {}
		else
			if string.len(global_clavier) == 1 then
				if global_clavier_maj["lock"] or global_clavier_maj["shift"] then
					global_clavier = string.upper(global_clavier)
					global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. global_clavier
				else
					global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. global_clavier
				end
				if global_edit_variable["nom"] == "mdp" or global_edit_variable["nom"] == "confirm" or global_edit_variable["nom"] == "ancienmdp" then
					global_variable[global_edit_variable["nom"].."_len"] = global_variable[global_edit_variable["nom"].."_len"] .. "*"
				end
			else
				global_variable[global_edit_variable["nom"]] = global_variable[global_edit_variable["nom"]] .. convertkey_number_altgr(global_clavier)
				if global_edit_variable["nom"] == "mdp" or global_edit_variable["nom"] == "confirm" or global_edit_variable["nom"] == "ancienmdp" then
					if convertkey_number_altgr(global_clavier) ~= "" then
						global_variable[global_edit_variable["nom"].."_len"] = global_variable[global_edit_variable["nom"].."_len"] .. "*"
					end
				end
			end
		end
	end
	genere_term_affichage()
end