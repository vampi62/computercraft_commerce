bool_use = true
utilisateur = ""
mot de passe = ""
depot = {0,0,0,0,0}
retrait = {0,0,0,0,0}
solde = 0
pret = 0
temp_pret = {0,0,0,0,0}
slot = 0
abo_slot = 0
role = 0
select_line/page = 0

time = {0,0,0,0,0}
desti = {0,0,0,0,0}
status = {0,0,0,0,0} -- terminer, rejeter, 
function modele_menu(mon,numero_box) --0
	local send_to_term = {}
	table.insert(send_to_term,1,{"clear","",""})
	table.insert(send_to_term,2,{"cursor","1","1"})
	table.insert(send_to_term,3,{"back","128",""})
	table.insert(send_to_term,4,{"write","connexion",""})
	table.insert(send_to_term,5,{"cursor","1","3"})
	table.insert(send_to_term,6,{"write","inscription",""})
	table.insert(send_to_term,7,{"back","32768",""})
	
end
function modele_inscription_pseudo(mon,numero_box) --10
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("login")
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("retour")
	mon.setBackgroundColor(32768)
	mon.setCursorPos(10,19)
	mon.write("entrer votre pseudo dans le terminal")
end
function modele_inscription_mdp(mon,numero_box) --11
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("login :"..session[numero_box][2])
	mon.setCursorPos(1,3)
	mon.write("mdp")

	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("retour")
	mon.setBackgroundColor(32768)
	mon.setCursorPos(10,19)


	read(pass)


end
function modele_inscription_confirme_mdp(mon,numero_box) --12
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("login")
	mon.setCursorPos(1,3)
	mon.write(session[numero_box][2])
	mon.setCursorPos(1,5)
	mon.write("mdp")
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("retour")
	mon.setBackgroundColor(32768)
	mon.setCursorPos(10,19)
	mon.write("retaper votre mot de passe dans le terminal")
end
function modele_login(mon,numero_box) --20
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("login")
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("retour")
	mon.setBackgroundColor(32768)
	mon.setCursorPos(10,19)
	mon.write("entrer votre pseudo dans le terminal")
end
function modele_password_login(mon,numero_box) --21
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("login")
	mon.setCursorPos(1,2)
	mon.write(session[numero_box][2])
	mon.setCursorPos(1,3)
	mon.write("mdp")
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("retour")
	mon.setBackgroundColor(32768)
	mon.setCursorPos(10,19)
	mon.write("entrer votre mot de passe dans le terminal")
end
function modele_menuconnected(mon,numero_box) --30
	mon.clear()
	mon.setCursorPos(1,1)
	mon.setBackgroundColor(128)
	mon.write("1  - retire       ")
	mon.setCursorPos(1,3)
	mon.write("2  - inser        ")
	mon.setCursorPos(1,5)
	mon.write("3  - pret         ")
	mon.setCursorPos(1,7)
	mon.write("4  - option       ")
	mon.setCursorPos(1,9)
	mon.write("5  - relever      ")
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("deconnexion")
	mon.setBackgroundColor(32768)
end
function modele_retrait(mon,numero_box) --40
	mon.clear()
	mon.setCursorPos(1,2)
	mon.write("vous avez   - "..session[numero_box][6])
	local demande = 0
	for j = 1, #session[numero_box][5] do
		local demande = demande + session[numero_box][5][j] * piece_valeur[j]
	end
	mon.setCursorPos(1,4)
	mon.write("vous voulez - "..demande)
	mon.setCursorPos(16,8)
	for a = 1, 5 do
		mon.setBackgroundColor(128)
		mon.write(" /\\ ")
		mon.setBackgroundColor(32768)
		mon.write(" ")
	end
	mon.setCursorPos(16,9)
	mon.write(" 10k  1k   100  10    1 ")
	mon.setCursorPos(16,10)
	for a = 1, 5 do
		mon.setBackgroundColor(128)
		mon.write(" \\/ ")
		mon.setBackgroundColor(32768)
		mon.write(" ")
	end
	mon.setBackgroundColor(128)
	mon.setCursorPos(15,19)
	mon.write("annuler")
	mon.setBackgroundColor(128)
	mon.setCursorPos(30,19)
	mon.write("valider")
	mon.setBackgroundColor(32768)
end
function modele_depot(mon,numero_box) --50
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("deposer vos pièces")
	mon.setCursorPos(1,2)
	local demande = 0
	for j = 1, #session[numero_box][4] do
		local demande = demande + session[numero_box][4][j] * piece_valeur[j]
	end
	mon.write("comptabiliser "..demande)
	mon.setCursorPos(1,3)
	mon.write("nouveau solde "..demande + session[numero_box][6])
	mon.setCursorPos(1,19)
	mon.setBackgroundColor(128)
	mon.write("retour")
	mon.setBackgroundColor(32768)
end
function modele_pret_menu(mon,numero_box) --60
	mon.clear()
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,1)
	mon.write("contract")
	mon.setCursorPos(1,2)
	mon.write("rembourse")
	mon.setCursorPos(1,19)
	mon.write("retour")
	mon.setBackgroundColor(32768)
end
function modele_pret_contract(mon,numero_box) --70
	local ex = session[numero_box][8][1]/550000
	local ex = math.exp(ex)
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("taux d'interet    - "..ex)
	mon.setCursorPos(1,2)
	mon.write("somme verser      - "..session[numero_box][8][1])
	mon.setCursorPos(1,3)
	mon.write("somme a payer     - "..session[numero_box][8][1]*ex)
	mon.setCursorPos(1,4)
	mon.write("total des pret    - "..session[numero_box][8][1]*ex + session[numero_box][7])
	mon.setCursorPos(1,10)
	mon.write("confirmer le pret")
	mon.setBackgroundColor(128)
	mon.setCursorPos(15,19)
	mon.write("non")
	mon.setCursorPos(30,19)
	mon.write("oui")
	mon.setBackgroundColor(32768)
end
function modele_pret_rembourse(mon,numero_box) --80
	mon.clear()
	mon.setCursorPos(1,2)
	mon.write("vous devez   - "..session[numero_box][7])
	local demande = 0
	for j = 1, #piece_retour do
		local demande = demande + session[numero_box][8][j] * piece_valeur[j]
	end
	mon.setCursorPos(1,4)
	mon.write("vous voulez rembourser - "..demande)
	mon.setCursorPos(1,6)
	mon.write("il vous restera - "..session[numero_box][7] + demande)
	mon.setCursorPos(16,8)
	for a = 1, 5 do
		mon.setBackgroundColor(128)
		mon.write(" /\\ ")
		mon.setBackgroundColor(32768)
		mon.write(" ")
	end
	mon.setCursorPos(16,9)
	mon.write(" 10k  1k   100  10    1 ")
	mon.setCursorPos(16,10)
	for a = 1, 5 do
		mon.setBackgroundColor(128)
		mon.write(" \\/ ")
		mon.setBackgroundColor(32768)
		mon.write(" ")
	end
	mon.setBackgroundColor(128)
	mon.setCursorPos(15,19)
	mon.write("annuler")
	mon.setCursorPos(30,19)
	mon.write("valider")
	mon.setBackgroundColor(32768)
end
function modele_administration(mon,numero_box) --90
	mon.clear()
	mon.setCursorPos(1,1)
	mon.setBackgroundColor(128)
	mon.write("1  -              ")
	mon.setCursorPos(1,2)
	mon.write("3  - regen key api")
	mon.setCursorPos(1,4)
	mon.write("4  - recup data   ")
	mon.setCursorPos(1,6)
	mon.write("6  - modif mdp    ")
	if session[numero_box][11] == true then
		mon.setCursorPos(1,7)
		mon.write("7  - admin        ")
	end
	mon.setCursorPos(1,19)
	mon.write("retour")
	mon.setBackgroundColor(32768)
end
function modele_export_data_wait(mon,numero_box) --100
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("entrer un disque vierge dans le lecteur")
	mon.setCursorPos(1,2)
	mon.write("pour recuperer vos données")
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("annuler")
	mon.setBackgroundColor(32768)
end
function modele_export_data_done(mon,numero_box) --100
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("recuperation terminer")
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("retour")
	mon.setBackgroundColor(32768)
end
function modele_change_mdp(mon,numero_box) --110
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("tape ton nouveau mdp")
	mon.setCursorPos(1,2)
	mon.write("si tu a des commerces il faudra que")
	mon.setCursorPos(1,3)
	mon.write("tu actualise leur mdp sinon il ne prendra")
	mon.setCursorPos(1,4)
	mon.write("pas en compte les commandes et les retards")
	mon.setCursorPos(1,5)
	mon.write("de livraison coutent cher")
	mon.setCursorPos(1,18)
	mon.write("mdp")
	mon.setBackgroundColor(128)
	mon.setCursorPos(15,19)
	mon.write("annuler")
	mon.setCursorPos(30,19)
	mon.write("valider")
	mon.setBackgroundColor(32768)
end
function modele_achat_slot(mon,numero_box) --120
	for j = 1 , 10 do
		if j+session[numero_box][9] <= max_slot then
			mon.setCursorPos(1,j+1)
			mon.write("prix pour "..j)
			mon.setCursorPos(15,j+1)
			local act_p = math.exp(math.log10(j*session[numero_box][9]))
			local act_p = act_p*slot_tarif_depart
			local act_p = math.floor(act_p)
			if j+1 == session[numero_box][12] then
				mon.setBackgroundColor(8192)
				mon.write(act_p)
				mon.setBackgroundColor(32768)
			else
				mon.write(act_p)
			end
		end
	end
	mon.setCursorPos(1,13)
	mon.write(session[numero_box][9].."/"..max_slot)
	mon.setCursorPos(1,19)
	mon.setBackgroundColor(128)
	mon.setCursorPos(15,19)
	mon.write("annuler")
	mon.setCursorPos(30,19)
	mon.write("valider")
	mon.setBackgroundColor(32768)
end
function modele_achat_abo_slot(mon,numero_box) --130
	for j = 1 , 10 do
		if j+session[numero_box][10] <= max_abo_slot then
			mon.setCursorPos(1,j+1)
			mon.write("prix pour "..j)
			mon.setCursorPos(15,j+1)
			local act_p = math.exp(math.log10(j*session[numero_box][10]))
			local act_p = act_p*abo_slot_tarif_depart
			local act_p = math.floor(act_p)
			if j+1 == session[numero_box][12] then
				mon.setBackgroundColor(8192)
				mon.write(act_p)
				mon.setBackgroundColor(32768)
			else
				mon.write(act_p)
			end
		end
	end
	mon.setCursorPos(1,13)
	mon.write(session[numero_box][10].."/"..max_abo_slot)
	mon.setCursorPos(1,19)
	mon.setBackgroundColor(128)
	mon.setCursorPos(15,19)
	mon.write("annuler")
	mon.setCursorPos(30,19)
	mon.write("valider")
	mon.setBackgroundColor(32768)
end
function modele_transaction_liste(mon,numero_box) --140
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("+-------------+-----------------+------------+----------+")
	mon.setCursorPos(1,2)
	mon.write("|    date     |   destination   |   status   | echange  |")
	mon.setCursorPos(1,3)
	mon.write("+-------------+-----------------+------------+----------+")
	local jy = 1
	for j = 15*session[numero_box][12]+1, #transaction_box[numero_box] do
		mon.setCursorPos(1,3+jy)
		mon.write("| "..transaction_box[numero_box][1][j])
		mon.setCursorPos(15,3+jy)
		mon.write("| "..transaction_box[numero_box][2][j])
		mon.setCursorPos(33,3+jy)
		mon.write("| "..transaction_box[numero_box][3][j])
		mon.setCursorPos(46,3+jy)
		mon.write("|"..transaction_box[numero_box][4][j])
		jy = jy + 1
	end
	local x, y = mon.getCursorPos()
	mon.setCursorPos(1,y+1)
	mon.write("+-------------+-----------------+------------+----------+")
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("exit")
	mon.setBackgroundColor(32768)
end
function modele_admin_menu(mon,numero_box) --200
	mon.clear()
	mon.setCursorPos(1,1)
	mon.setBackgroundColor(128)
	mon.write("1  - mise a jour  ")
	mon.setCursorPos(1,2)
	mon.write("3  - arret        ")
	mon.setCursorPos(1,19)
	mon.write("retour")
	mon.setBackgroundColor(32768)
end
function modele_admin_mise_a_jour(mon,numero_box) --210
	mon.clear()
	mon.setCursorPos(1,1)
	for j = 1, #session do
		mon.setCursorPos(1,j+2)
		mon.write("box "..j " : "..session[1][1])
	end
	mon.setBackgroundColor(128)
	mon.setCursorPos(1,19)
	mon.write("annuler")
	mon.setBackgroundColor(32768)
end
function modele_admin_arret(mon,numero_box) --220
	mon.clear()
	mon.setCursorPos(1,1)
	for j = 1, #session do
		mon.setCursorPos(1,j+2)
		mon.write("box "..j " : "..session[1][1])
	end
end

function modele_info_ecran_ext(mon,numero_box) --300
	mon.clear()
	mon.setCursorPos(1,1)
	mon.write("a venir")
end

function modele_error_pas_argent(mon,numero_box) --400
	mon.setCursorPos(1,1)
	mon.write("error")
	mon.setCursorPos(1,2)
	mon.write("pas assez sur le compte")
end
function modele_error_slot_max(mon,numero_box) --410
	mon.setCursorPos(1,1)
	mon.write("error")
	mon.setCursorPos(1,2)
	mon.write("limite de 100 offre maxi")
end
function modele_error_db(mon,numero_box) --420
	mon.setCursorPos(1,1)
	mon.write("error")
	mon.setCursorPos(1,2)
	mon.write("db error")
end
function modele_error_place(mon,numero_box) --430
	mon.setCursorPos(1,1)
	mon.write("error")
	mon.setCursorPos(1,2)
	mon.write("plus de place disk")
end
function modele_error_pseudo(mon,numero_box) --440
	mon.setCursorPos(1,1)
	mon.write("error")
	mon.setCursorPos(1,2)
	mon.write("pseudo deja utiliser")
end
function modele_error_mdp(mon,numero_box) --450
	mon.setCursorPos(1,1)
	mon.write("error")
	mon.setCursorPos(1,2)
	mon.write("mot de passe incorrect")
end
function modele_error_confirm_mdp(mon,numero_box) --460
	mon.setCursorPos(1,1)
	mon.write("error")
	mon.setCursorPos(1,2)
	mon.write("mot de passe incorrect")
end