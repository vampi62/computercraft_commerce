function rangement_liste(liste_et_data)
	liste_et_data["objet"] = global_liste[liste_et_data["liste"]]
	if global_variable["rangeliste"]["id"] == liste_et_data["champ"] and global_variable["rangeliste"]["mode"] ~= "+" then
		global_variable["rangeliste"]["id"] = liste_et_data["champ"]
		global_variable["rangeliste"]["mode"] = "+"
		if global_variable["rangeliste"]["type"] == "int" then
			table.sort(liste_et_data["objet"], function(a, b) return tonumber(a[global_variable["rangeliste"]["id"]]) < tonumber(b[global_variable["rangeliste"]["id"]]) end)
		else
			table.sort(liste_et_data["objet"], function(a, b) return a[global_variable["rangeliste"]["id"]] < b[global_variable["rangeliste"]["id"]] end)
		end
	else
		global_variable["rangeliste"]["id"] = liste_et_data["champ"]
		global_variable["rangeliste"]["mode"] = "-"
		if global_variable["rangeliste"]["type"] == "int" then
			table.sort(liste_et_data["objet"], function(a, b) return tonumber(a[global_variable["rangeliste"]["id"]]) > tonumber(b[global_variable["rangeliste"]["id"]]) end)
		else
			table.sort(liste_et_data["objet"], function(a, b) return a[global_variable["rangeliste"]["id"]] > b[global_variable["rangeliste"]["id"]] end)
		end
	end
	global_liste[liste_et_data["liste"]] = liste_et_data["objet"]
end