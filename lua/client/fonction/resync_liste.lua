function resync_liste(liste,force_update)
	if (os.time()*50 >= global_liste[liste]["date_sync"]) or force_update then
		http_commande("http_"..liste)
		global_reapliquer_filtre = true
	end
end