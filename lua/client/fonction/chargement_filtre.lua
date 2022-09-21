function chargement_filtre(liste)
	local postion_tab_filtre = {}
	local filtre_liste = {}
	for k,v in pairs(global_filtre) do
		for j=1, #global_table_http[liste] do
			if k == global_table_http[liste][j] then
				postion_tab_filtre[k]=j
				break
			end
		end
	end
	for j=1, #global_liste[liste] do
		filtre_passer = true
		for k,v in pairs(postion_tab_filtre) do
			if global_filtre[k]["type"] == "compare" then
				if not(global_liste[liste][j][v] == global_filtre[k]["value"]) then
					filtre_passer = false
				end
			elseif global_filtre[k]["type"] == "diff" then
				if not(global_liste[liste][j][v] ~= global_filtre[k]["value"]) then
					filtre_passer = false
				end
			elseif global_filtre[k]["type"] == "supp" then
				if not(global_liste[liste][j][v] >= global_filtre[k]["value"]) then
					filtre_passer = false
				end
			elseif global_filtre[k]["type"] == "inff" then
				if not(global_liste[liste][j][v] <= global_filtre[k]["value"]) then
					filtre_passer = false
				end
			elseif global_filtre[k]["type"] == "find" then
				if not(string.find(global_liste[liste][j][v],global_filtre[k]["value"])) then
					filtre_passer = false
				end
			elseif global_filtre[k]["type"] == "date" then
				objet = split(global_liste[liste][j][v],"-")
				interval = split(global_filtre[k]["value"],"-")
				now=os.time{day=global_ntp["jour"],year=global_ntp["annee"],month=global_ntp["mois"]}
				interval=os.time{day=interval[3],year=interval[1],month=interval[2]}
				objet=os.time{day=objet[3],year=objet[1],month=objet[2]}
				if not(now-interval >= now-objet) then
					filtre_passer = false
				end
			end
		end
		if filtre_passer then
			table.insert(filtre_liste,global_liste[liste][j])
		end
	end
	return filtre_liste
end