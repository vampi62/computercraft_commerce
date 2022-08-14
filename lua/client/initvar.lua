if not fs.exists(fichier_config) then
	files = fs.open(fichier_config, "w")
	files.write("global_poste = '' -- client, banque-terminal, banque-routeur, commerce")
	files.write("global_dns = 'http://__ip__or__domain__:port_if_dif_80/chemin/vers//lua/'")
	files.write("global_interval_minute_db = 1-5")
	files.close()
end
if not fs.exists(fichier_session) then
	files = fs.open(fichier_session, "w")
	files.write("session_pseudo = ''")
	files.write("session_mdp = ''")
	files.close()
end