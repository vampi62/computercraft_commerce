function chargement_filtre(liste,comparatif_0,champ1_0,champ2_0)
	if global_reapliquer_filtre then
		if comparatif_0 ~= nil then
			for j=1, #global_liste[liste] do
				if global_liste[liste][j][champ1_0] ~= comparatif_0 then
					global_liste[liste][j][0] = global_liste[liste][j][champ1_0]
				else
					global_liste[liste][j][0] = global_liste[liste][j][champ2_0]
				end
			end
		end
		local postion_tab_filtre = {}
		for k,v in pairs(global_filtre) do
			for j=1, #global_table_http[liste] do
				if k == global_table_http[liste][j] then
					postion_tab_filtre[k]=j
					break
				end
			end
		end
		global_filtre_liste[liste] = {}
		for j=1, #global_liste[liste] do
			filtre_passer = true
			for k,v in pairs(postion_tab_filtre) do
				if global_filtre[k]["type"] == "egal" then -- identique a la valeur rechercher
					if not(global_liste[liste][j][v] == global_filtre[k]["valeur"]) then
						filtre_passer = false
					end
				elseif global_filtre[k]["type"] == "diff" then -- different de la valeur rechercher
					if not(global_liste[liste][j][v] ~= global_filtre[k]["valeur"]) then
						filtre_passer = false
					end
				elseif global_filtre[k]["type"] == "supp" then -- superieur de la valeur rechercher (format nombre uniquement)
					if not(global_liste[liste][j][v] >= global_filtre[k]["valeur"]) then
						filtre_passer = false
					end
				elseif global_filtre[k]["type"] == "inff" then -- inferieur de la valeur rechercher (format nombre uniquement)
					if not(global_liste[liste][j][v] <= global_filtre[k]["valeur"]) then
						filtre_passer = false
					end
				elseif global_filtre[k]["type"] == "find" then -- trouve une chaine dans la ligne (format texte uniquement)
					if not(string.find(global_liste[liste][j][v],global_filtre[k]["valeur"])) then
						filtre_passer = false
					end
				elseif global_filtre[k]["type"] == "date" then -- plus recent de la valeur rechercher (format date uniquement yyyy-mm-dd)
					objet = split(global_liste[liste][j][v],"-")
					interval = split(global_filtre[k]["valeur"],"-")
					now=os.time{day=global_ntp["jour"],year=global_ntp["annee"],month=global_ntp["mois"]}
					interval=os.time{day=interval[3],year=interval[1],month=interval[2]}
					objet=os.time{day=objet[3],year=objet[1],month=objet[2]}
					if not(now-interval >= now-objet) then
						filtre_passer = false
					end
				end
			end
			if filtre_passer then
				table.insert(global_filtre_liste[liste],global_liste[liste][j])
			end
		end
		global_scroll = 0
		global_reapliquer_filtre = false
	end
end