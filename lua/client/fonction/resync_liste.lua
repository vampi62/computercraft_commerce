function resync_liste(liste)
	if #global_liste[liste] <= 2 or (os.time()*50 >= global_liste[liste]["date_sync"]) then
		global_liste[liste] = http_commande("http_"..liste)
		global_reapliquer_filtre = true
	end
end