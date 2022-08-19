function save_session()
	files = fs.open(fichier_session, "w")
	files.write("session_pseudo = "..session[1])
	files.write("session_mdp = "..session[2])
	files.close()
end
function save_panier()
files = fs.open(fichier_session, "w")
files.write("session_pseudo = "..session[1])
files.write("session_mdp = "..session[2])
files.close()
end