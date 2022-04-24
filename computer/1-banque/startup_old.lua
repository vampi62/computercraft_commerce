if fs.exists("renvoi") == false then
	file = fs.open("renvoi", "w")
	file.writeLine("renvoi_tampo = {}")
	file.close()
end
if fs.exists("update") == false then
	file = fs.open("update", "w")
	file.close()
end
shell.run("commande")
shell.run("attente")
shell.run("renvoi")
shell.run("cert_abo")
if fs.exists(address) == false then
	file = fs.open(address, "w")
	file.writeLine("pub = {}")
	file.writeLine("priv = {}")
	file.writeLine("compte_coffre = {}")
	file.writeLine("mdp = {}")
	file.writeLine("player = {}")
	file.writeLine("pret = {}")
	file.writeLine("mdp_auto = {}")
	file.writeLine("offre_max = {}")
	file.writeLine("pc_dest = {}")
	file.writeLine("gate_dest = {}")
	file.writeLine("verif_compte = {}")
	file.close()
end
function save()
	files = fs.open(address, "w")
	files.write("player = "..textutils.serialize(player))
	files.write("mdp = "..textutils.serialize(mdp))
	files.write("mdp_auto = "..textutils.serialize(mdp_auto))
	files.write("pub = "..textutils.serialize(pub))
	files.write("priv = "..textutils.serialize(priv))
	files.write("compte_coffre = "..textutils.serialize(compte_coffre))
	files.write("pret = "..textutils.serialize(pret))
	files.write("offre_max = "..textutils.serialize(offre_max))
	files.write("verif_compte = "..textutils.serialize(verif_compte))
	files.write("pc_dest = "..textutils.serialize(pc_dest))
	files.write("gate_dest = "..textutils.serialize(gate_dest))
	files.close()
	shell.run(address)
end
function save_histo(zh, comm)
	a, err = http.get("http://"..httpdns.."/update/site.php?action=actu&id="..player[zh].."&mdp="..mdp[zh].."&banque="..mdp[1].."&compte="..compte_coffre[zh])
	a = zh/5
	a = math.ceil(a)
	files = fs.open("/"..disk.getMountPath(drive_datac[a]).."/"..player[zh].."-relever", "w")
	if comm == nil then
		files.writeLine("type_banque = "..textutils.serialize(type_banque_c))
		files.writeLine("time_date = "..textutils.serialize(time_date_c))
		files.writeLine("total = "..textutils.serialize(total_c))
		files.writeLine("destinataire = "..textutils.serialize(destinataire_c))
		files.writeLine("time = "..textutils.serialize(time_c))
		files.writeLine("info = "..textutils.serialize(info_c))
	else
		files.writeLine("type_banque = "..textutils.serialize(type_banque))
		files.writeLine("time_date = "..textutils.serialize(time_date))
		files.writeLine("total = "..textutils.serialize(total))
		files.writeLine("destinataire = "..textutils.serialize(destinataire))
		files.writeLine("time = "..textutils.serialize(time))
		files.writeLine("info = "..textutils.serialize(info))
	end
	files.close()
	files = fs.open("/"..disk.getMountPath(drive_datac[a]).."/"..player[zh].."-histo-cert_abo", "w")
	if comm == nil then
		files.writeLine("abo_perso = "..textutils.serialize(abo_perso_c))
	else
		files.writeLine("abo_perso = "..textutils.serialize(abo_perso))
	end
	files.close()
end
function increment(new,nbr,init,verif,err)
	if init ~= nil then
		if init == false then
			verif, err = http.get("http://"..httpdns.."/update/index.php?action=new&id="..player[new].."&para1="..mdp_auto[new].."&mdp="..mdp[new].."&banque="..mdp[1])
		end
	else
		verif, err = http.get("http://"..httpdns.."/update/index.php?action=increment&id="..player[new].."&mdp="..mdp[new].."&banque="..mdp[1].."&para1="..nbr)
	end
	if verif then
		verif = verif.readAll()
		if verif ~= "db_error" then
			taille = string.len(verif)
			c = 0
			val = "<br />"
			t = 1
			val_posd = {}
			val_posf = {}
			repeat
				c = c + 1
				test = string.sub(verif,c,c+5)
				if string.find(test,val) then
					val_posd[t] = c - 1
					val_posf[t] = c + 6
					t = t + 1
				end
			until c >= taille
			f = fs.open(historiacces,"a")
			vendeur_l = string.sub(verif,1,val_posd[1])
			mon2.clear()
			mon2.setCursorPos(1,1)
			mon2.write(player[new])
			mon2.setCursorPos(1,2)
			mon2.write(vendeur_l)
			f.writeLine(player[new])
			f.writeLine(vendeur_l)
			f.close()
			sleep(20)
			return true
		else
			sleep(20)
			return false
		end
	else
		sleep(20)
		return false
	end
end
function rapport_client(fait, client, vendeur)
	if fait ~= nil then
		if fait == true then
			
		else
			
		end
	else
		a = client/5
		a = math.ceil(a)
		shell.run("/"..disk.getMountPath(drive_datac[a]).."/"..player[client].."-relever")
		shell.run("/"..disk.getMountPath(drive_datac[a]).."/"..player[client].."-histo-cert_abo")
		type_banque[#type_banque+1] = "commerce"
		time_date[#type_banque] = Hour.."h"..Minute.." "..day.."/"..mois
		total[#type_banque] = "-"..transfer
		destinataire[#type_banque] = player[vendeur]
		time[#type_banque] = Hour.."/"..dday.."/"..mmois
		info[#type_banque] = "na"
		save_histo(client, true)
	end
end
function rapport_vendeur(fait, vendeur, client)
	if fait ~= nil then
		if fait == true then
			
		else
			
		end
	else
		a = vendeur/5
		a = math.ceil(a)
		shell.run("/"..disk.getMountPath(drive_datac[a]).."/"..player[vendeur].."-relever")
		shell.run("/"..disk.getMountPath(drive_datac[a]).."/"..player[vendeur].."-histo-cert_abo")
		type_banque[#type_banque+1] = "commerce"
		time_date[#type_banque] = Hour.."h"..Minute.." "..day.."/"..mois
		total[#type_banque] = "+"..transfer
		destinataire[#type_banque] = player[client]
		time[#type_banque] = Hour.."/"..dday.."/"..mmois
		info[#type_banque] = "na"
		save_histo(vendeur, true)
	end
end
config_id = ".id_config"
shell.run(config_data)
if disk.getLabel(drive_data) == "var-id" then
	list = fs.list("/"..disk.getMountPath(drive_data).."/")
	for a = 1, #list do
		var = crypto.hash("SHA-256",list[a])
		if var == mdp_id then
			fs.delete(config_id)
			fs.delete("player")
			fs.delete("/"..disk.getMountPath(drive_data).."/"..list[a])
			fs.copy("/"..disk.getMountPath(drive_data).."/id",config_id)
			fs.copy("/"..disk.getMountPath(drive_data).."/player","player")
			shell.run(config_id)
			shell.run(address)
			break
		end
	end
end
shell.run(config_id)
shell.run("player")
shell.run(address)
shell.run("echec")
if #mdp == 0 then
	pub_n, priv_n = crypto.generateKeyPair("RSA", 512)
	pub[1] = pub_n.encode()
	priv[1] = priv_n.encode()
	pub_d[1] = crypto.decodeKey("RSA", pub[1])
	priv_d[1] = crypto.decodeKey("RSA", priv[1])
	repeat
		key_text = read()
	until string.len(key_text) > 5
	player[1] = "banque_routeur"
	verif_compte[1] = false
	pc_dest[1] = 0
	gate_dest[1] = "xxxxxxxx"
	mdp = {}
	mdp[1] = crypto.hash("SHA1",key_text)
	compte_coffre[1] = 0
	pret[1] = 0
	mdp_auto[1] = crypto.hash("SHA1",key_text.."-auto")
	offre_max[1] = 25
	save()
	verif, err = http.get("http://"..httpdns.."/update/index.php?action=new&id=banque_routeur&mdp="..mdp[1].."&para1="..mdp_auto[1].."&banque="..mdp[1])
	increment(1,25,true,verif,err)
	verif, err = http.get("http://"..httpdns.."/update/site.php?action=new&id=banque_routeur&mdp="..mdp[1].."&banque="..mdp[1])
end

mon2.setTextScale(0.5)
redstone.setBundledOutput(bSide,colors.combine(redstone.getBundledOutput(bSide),colors.blue))

function retour()
	supp = 0
	repeat
		if piece_retour[1] > 0 and nbr_piece[1] >= piece_retour[1] then
			inter.exportItem(item[5],inter_direction,1)
			compte_coffre[z] = compte_coffre[z] - 10000
			piece_retour[1] = piece_retour[1] - 1
		else
			supp = 1
		end
	until supp == 1
	supp = 0
	repeat
		if piece_retour[2] > 0 and nbr_piece[2] >= piece_retour[2] then
			inter.exportItem(item[4],inter_direction,1)
			compte_coffre[z] = compte_coffre[z] - 1000
			piece_retour[2] = piece_retour[2] - 1
		else
			supp = 1
		end
	until supp == 1
	supp = 0
	repeat
		if piece_retour[3] > 0 and nbr_piece[3] >= piece_retour[3] then
			inter.exportItem(item[3],inter_direction,1)
			compte_coffre[z] = compte_coffre[z] - 100
			piece_retour[3] = piece_retour[3] - 1
		else
			supp = 1
		end
	until supp == 1
	supp = 0
	repeat
		if piece_retour[4] > 0 and nbr_piece[4] >= piece_retour[4] then
			inter.exportItem(item[2],inter_direction,1)
			compte_coffre[z] = compte_coffre[z] - 10
			piece_retour[4] = piece_retour[4] - 1
		else
			supp = 1
		end
	until supp == 1
	supp = 0
	repeat
		if piece_retour[5] > 0 and nbr_piece[5] >= piece_retour[5] then
			inter.exportItem(item[1],inter_direction,1)
			compte_coffre[z] = compte_coffre[z] - 1
			piece_retour[5] = piece_retour[5] - 1
		else
			supp = 1
		end
	until supp == 1
	supp = 0
end
function prod()
	init_me()
	while true do
		if libre == true then
			redstone.setBundledOutput(bSide,colors.subtract(redstone.getBundledOutput(bSide),colors.white))
		else
			redstone.setBundledOutput(bSide,colors.combine(redstone.getBundledOutput(bSide),colors.white))
		end
		melist = ae.getAvailableItems()
		itemName = {}
		size = {}
		item = {}
		nbr_piece = {0,0,0,0,0}
		for a = 1, #melist do
			itemName[a] = melist[a].fingerprint.id
			size[a] = melist[a].size
			for aa = 1, #piece do
				if piece[aa] == itemName[a] then
					nbr_piece[aa] = size[a]
					item[aa] = melist[a].fingerprint
				end
			end
		end
		compte = nbr_piece[1] + nbr_piece[2]*10 + nbr_piece[3]*100 + nbr_piece[4]*1000 + nbr_piece[5]*10000
		sleep(1)
	end
end
function affich()
	while true do
		libre = true
		admin2 = false
		mon2.clear()
		mon2.setCursorPos(1,1)
			mon2.setBackgroundColor(128)
			mon2.write("load")
			mon2.setCursorPos(1,2)
			mon2.write("new")
			mon2.setBackgroundColor(32768)
			sleep(0,2)
			if act == "0" then
				mon2.clear()
				mon2.setCursorPos(1,1)
				mon2.write("login")
				mon2.setCursorPos(1,3)
				mon2.write("utilise le capteur d'empreinte")
				libre = false
				name = nil
				repeat
					sleep(0.5)
					if name ~= nil then
						z = 0
						repeat
							z = z + 1
							if z > #player then
								nop = 1
							end
						until biolock.getPrint(player[z]) == name or nop == 1
					end
				until name ~= nil or nop == 1
				if nop == 1 then
					nop = 0
				else
					mon2.clear()
					mon2.setCursorPos(1,1)
					mon2.write("mdp")
					mon2.setCursorPos(1,19)
					ecr()
					act = crypto.hash("SHA1",act)
					if act == mdp[z] then
						for a = 1, #admin do
							if player[z] == admin[a] then
								admin2 = true
							end
						end
						a = z/5
						a = math.ceil(a)
						shell.run("/"..disk.getMountPath(drive_datac[a]).."/"..player[z].."-relever")
						shell.run("/"..disk.getMountPath(drive_datac[a]).."/"..player[z].."-histo-cert_abo")
						histo_cert_c = histo_cert
						histo_abo_c = histo_abo
						type_banque_c = type_banque
						time_c = time
						time_date_c = time_date
						total_c = total
						destinataire_c = destinataire
						abo_perso_c = abo_perso
						info_c = info
						repeat
							mon2.clear()
							mon2.setCursorPos(1,1)
							mon2.setBackgroundColor(128)
							mon2.write("1  - retire       ")
							mon2.setCursorPos(1,2)
							mon2.write("2  - inser        ")
							mon2.setCursorPos(1,3)
							mon2.write("3  - pret         ")
							mon2.setCursorPos(1,4)
							mon2.write("4  - option       ")
							mon2.setCursorPos(1,5)
							mon2.write("5  - relever      ")
							mon2.setCursorPos(1,6)
							mon2.write("6  - cert         ")
							mon2.setCursorPos(1,7)
							mon2.write("7  - vos abo      ")
							mon2.setCursorPos(1,8)
							mon2.write("8  - clear pluie  ")
							mon2.setCursorPos(1,19)
							mon2.write("exit")
							mon2.setBackgroundColor(32768)
							sleep(0,2)
							if act == "0" and z > 1 then
								piece_retour = {0,0,0,0,0}
								repeat
								demande = 0
								mon2.clear()
								mon2.setCursorPos(1,2)
								mon2.write("vous avez   - "..compte_coffre[z])
								for c = 1, #piece_retour do
									demande = demande + piece_retour[c] * piece_quant[c]
								end
								mon2.setCursorPos(1,4)
								mon2.write("vous voulez - "..demande)
								mon2.setBackgroundColor(128)
								mon2.setCursorPos(22,15)
								mon2.write("valider")
								mon2.setCursorPos(16,8)
								for a = 1, 5 do
									mon2.setBackgroundColor(128)
									mon2.write(" /\\ ")
									mon2.setBackgroundColor(32768)
									mon2.write(" ")
								end
								mon2.setCursorPos(16,9)
								mon2.write(" 10k  1k   100  10    1 ")
								mon2.setCursorPos(16,10)
								for a = 1, 5 do
									mon2.setBackgroundColor(128)
									mon2.write(" \\/ ")
									mon2.setBackgroundColor(32768)
									mon2.write(" ")
								end
								mon2.setBackgroundColor(128)
								mon2.setCursorPos(1,19)
								mon2.write("exit")
								mon2.setBackgroundColor(32768)
								sleep(0.2)
								if act == "valider" and demande <= compte_coffre[z] then
									compte_tempo = compte_coffre[z]
									retour()
									mon2.clear()
									mon2.setCursorPos(1,1)
									if compte_tempo - demande < compte_coffre[z] then
										mon2.write("il n'y a pas assez de piece dans la banque")
										mon2.setCursorPos(1,2)
										mon2.write("credits distribuer - "..compte_tempo - compte_coffre[z])
										mon2.setCursorPos(1,3)
										mon2.write("credits demander   - "..demande)
										demande = compte_tempo - demande - compte_coffre[z]
										demande = demande - demande*2
										mon2.setCursorPos(1,4)
										mon2.write("credits manquants  - "..demande)
										mon2.setCursorPos(1,5)
										mon2.write("signaler a un administrateur le probleme")
										demande = compte_tempo - compte_coffre[z]
										compte_tempo = nil
										type_banque_c[#type_banque_c+1] = "retrait"
										time_date_c[#type_banque_c] = Hour.."h"..Minute.." "..day
										total_c[#type_banque_c] = "-"..demande
										destinataire_c[#type_banque_c] = "banque"
										time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
										info_c[#type_banque_c] = "na"
										save_histo(z)
										sleep(5)
									else
										mon2.write("retait terminer")
										demande = compte_tempo - compte_coffre[z]
										compte_tempo = nil
										type_banque_c[#type_banque_c+1] = "retrait"
										time_date_c[#type_banque_c] = Hour.."h"..Minute.." "..day
										total_c[#type_banque_c] = "-"..demande
										destinataire_c[#type_banque_c] = "banque"
										time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
										info_c[#type_banque_c] = "na"
										save_histo(z)
										sleep(2)
									end
									act = "-1"
								end
								until act == "exit"
								act = "-1"
							end
							if act == "1" and z > 1 then
								act = "0"
								redstone.setBundledOutput(bSide,colors.combine(redstone.getBundledOutput(bSide),colors.orange))
								compte_origina = compte_origin
								repeat
									mon2.clear()
									mon2.setBackgroundColor(128)
									mon2.setCursorPos(1,19)
									mon2.write("exit")
									mon2.setBackgroundColor(32768)
									mon2.setCursorPos(1,1)
									compte_coffre[z] = compte_coffre[z] + compte - compte_origin
									mon2.write(compte_coffre[z])
									save()
									compte_origin = compte
									sleep(0.5)
								until act == "exit"
								redstone.setBundledOutput(bSide,colors.subtract(redstone.getBundledOutput(bSide), colors.orange))
								compte_coffre[z] = compte_coffre[z] + compte - compte_origin
								type_banque_c[#type_banque_c+1] = "depot"
								time_date_c[#type_banque_c] = Hour.."h"..Minute.." "..day
								total_c[#type_banque_c] = "+"..compte - compte_origina
								destinataire_c[#type_banque_c] = "banque"
								time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
								info_c[#type_banque_c] = "na"
								save_histo(z)
								save()
								act = "-1"
							end
							if act == "2" and z > 1 then
								repeat
								mon2.clear()
								mon2.setCursorPos(1,1)
								mon2.write("contract")
								mon2.setCursorPos(1,2)
								mon2.write("rembourse")
								mon2.setCursorPos(1,19)
								mon2.setBackgroundColor(128)
								mon2.write("exit")
								mon2.setBackgroundColor(32768)
								mon2.setCursorPos(1,17)
								parallel.waitForAny(ecr, retour_ecr)
								sleep(0,2)
								if act == "0" then
									mon2.clear()
									mon2.setCursorPos(1,1)
									mon2.write("entrer la somme du pret voulue")
									mon2.setCursorPos(1,19)
									mon2.setBackgroundColor(128)
									mon2.write("exit")
									mon2.setBackgroundColor(32768)
									mon2.setCursorPos(1,17)
									parallel.waitForAny(ecr, retour_ecr)
									act = tonumber(act)
									if act == nil then
										act = 0
									end
									if act > 0 then
										ex = act/550000
										ex = math.exp(ex)
										mon2.clear()
										mon2.setCursorPos(1,1)
										mon2.write("taux d'interet    - "..ex)
										mon2.setCursorPos(1,2)
										mon2.write("somme verser      - "..act)
										mon2.setCursorPos(1,3)
										mon2.write("somme a payer     - "..act*ex)
										mon2.setCursorPos(1,4)
										mon2.write("total des pret    - "..act*ex+pret[z])
										mon2.setCursorPos(1,5)
										mon2.write("confirmer le pret")
										mon2.write("y/n")
										mon2.setCursorPos(1,19)
										actt = ecr()
										if actt == "y" then
											compte_coffre[z] = compte_coffre[z] + act
											pret[z] = pret[z] + act * ex
											pret[z] = math.floor(pret[z])
											type_banque_c[#type_banque_c+1] = "pret +"
											time_date_c[#type_banque_c] = Hour.."h"..Minute.." "..day
											total_c[#type_banque_c] = "+"..act
											destinataire_c[#type_banque_c] = "banque"
											time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
											info_c[#type_banque_c] = "na"
											save_histo(z)
										end
									end
								end
								if act == "1" and pret[z] > 0 then
									mon2.clear()
									mon2.setCursorPos(1,1)
									mon2.write("a rembourser - "..pret[z])
									mon2.setCursorPos(1,2)
									mon2.write("solde        - "..compte_coffre[z])
									mon2.setCursorPos(1,19)
									mon2.setBackgroundColor(128)
									mon2.write("exit")
									mon2.setBackgroundColor(32768)
									mon2.setCursorPos(1,17)
									parallel.waitForAny(ecr, retour_ecr)
									act = tonumber(act)
									if act == nil then
										act = 0
									end
									if act <= pret[z] and compte_coffre[z] >= act and act > 0 then
										pret[z] = pret[z] - act
										compte_coffre[z] = compte_coffre[z] - act
										type_banque_c[#type_banque_c+1] = "pret -"
										time_date_c[#type_banque_c] = Hour.."h"..Minute.." "..day
										total_c[#type_banque_c] = "-"..act
										destinataire_c[#type_banque_c] = "banque"
										time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
										info_c[#type_banque_c] = "na"
										save_histo(z)
									end
								end
								until act == "exit"
								act = "-1"
								save()
							end
							if act == "3" then
								act = "-1"
								repeat
								mon2.clear()
								mon2.setCursorPos(1,1)
								mon2.setBackgroundColor(128)
								mon2.write("1  -              ")
								mon2.setCursorPos(1,2)
								mon2.write("2  - plus         ")
								mon2.setCursorPos(1,3)
								mon2.write("3  - recup mdp    ")
								mon2.setCursorPos(1,4)
								mon2.write("4  - recup data   ")
								mon2.setCursorPos(1,5)
								mon2.write("5  - modif coo    ")
								mon2.setCursorPos(1,6)
								mon2.write("6  - modif mdp    ")
								if admin2 == true then
									mon2.setCursorPos(1,7)
									mon2.write("7  - admin        ")
								end
								mon2.setCursorPos(1,19)
								mon2.write("exit")
								mon2.setBackgroundColor(32768)
								sleep(0.2)
								if act == "5" then
									repeat
										mon2.clear()
										mon2.setCursorPos(1,1)
										mon2.write("tape ton nouveau mdp")
										mon2.setCursorPos(1,2)
										mon2.write("si tu a des commerces il faudra que")
										mon2.setCursorPos(1,3)
										mon2.write("tu actualise leur mdp sinon il ne prendra")
										mon2.setCursorPos(1,4)
										mon2.write("pas en compte les commandes et les retards")
										mon2.setCursorPos(1,5)
										mon2.write("de livraison coutent cher")
										mon2.setCursorPos(1,18)
										mon2.write("mdp")
										ecr()
										if act ~= nil then
											mdp_act = crypto.hash("SHA1",act)
										else
											mdp_act = "error"
										end
										mon2.setCursorPos(1,18)
										mon2.write("mdp_auto")
										ecr()
										if act ~= nil then
											mdp_auto_act = crypto.hash("SHA1",act)
										else
											mdp_auto_act = "error"
										end
									until mdp_act ~= "error" and mdp_auto_act ~= "error"
									verif = http.get("http://"..httpdns.."/update/index.php?action=modif_mdp&id="..player[z].."&para1="..mdp_act.."&para2="..mdp_auto[z].."&para3="..mdp_auto_act.."&mdp="..mdp[z].."&banque="..mdp[1])
									verif = verif.readAll()
									mon2.setCursorPos(10,15)
									if verif == "modif_mdp_ok" then
										verif = http.get("http://"..httpdns.."/update/site.php?action=new_mdp&id="..player[z].."&mdp_new="..mdp_act.."&mdp="..mdp[z].."&banque="..mdp[1])
										mon2.write("modif ok")
										mdp[z] = mdp_act
										mdp_auto[z] = mdp_auto_act
										rednet.send(serveur_news,"new_mdp_player")
										sleep(0.6)
										rednet.send(serveur_news,player[z])
										sleep(1.5)
										rednet.send(serveur_news,mdp_act)
									else
										mon2.write("error")
									end
									sleep(2)
									save()
								end
								if act == "2" and verif_compte[z] == true then
									event = "0"
									repeat
										sleep(0.5)
										if event == "mag_swipe" then
											enc = "mdp-"..mdp[z].."-cle-"..pub[z]
											reader.beginWrite(player[z],enc)
										end
									until event ~= "0"
								elseif act == "recup_mdp" and verif_compte[z] == false then
									mon2.clear()
									mon2.setCursorPos(1,1)
									mon2.write("la verification de votre compte")
									mon2.setCursorPos(1,2)
									mon2.write("n'a pas encore eu lieu")
									mon2.setCursorPos(1,3)
									mon2.write("contacter un administrateur")
									sleep(10)
								end
								if act == "3" then
									inst = 1
									mon2.clear()
									mon2.setCursorPos(1,1)
									mon2.write("insert ta disquette")
									mon2.setCursorPos(1,2)
									mon2.write("puis appuie sur entrer")
									mon2.setCursorPos(1,19)
									ecr()
									inst = 0
								end
								if act == "6" and admin2 == true then
									repeat
									mon2.clear()
									mon2.setCursorPos(1,1)
									mon2.setBackgroundColor(128)
									mon2.write("1  - compte_banque")
									mon2.setCursorPos(1,2)
									mon2.write("2  - fichier      ")
									mon2.setCursorPos(1,3)
									mon2.write("3  - porte        ")
									mon2.setCursorPos(1,4)
									mon2.write("4  - arret        ")
									mon2.setCursorPos(1,5)
									mon2.write("5  - update       ")
									mon2.setCursorPos(1,6)
									mon2.write("6  - verif        ")
									mon2.setCursorPos(1,7)
									mon2.write("7  - ping         ")
									mon2.setCursorPos(1,8)
									mon2.write("8  - ping_h       ")
									mon2.setCursorPos(1,9)
									mon2.write("9  -              ")
									mon2.setCursorPos(1,10)
									mon2.write("10 - error files  ")
									mon2.setCursorPos(1,12)
									mon2.write("error files  -- "..#echec)
									mon2.setCursorPos(1,19)
									mon2.write("exit")
									mon2.setBackgroundColor(32768)
									sleep(0.2)
									if var == "1" then
										repeat
											var = "-2"
											liste = fs.list(navx)
											term.clear()
											term.setCursorPos(1,1)
											print("nav : "..navx)
											print("exit")
											for a = 1, 16 do
												if liste[a] ~= nil then
													print(liste[a])
												end
											end
											sleep(0.2)
											if var == "0" then
												taille = string.len(navx)
												c = 0
												val = "/"
												repeat
													c = c + 1
													test = string.sub(navx,c,c)
													if string.find(navx,val) then
														val_posd = c
													end
												until c >= taille
												navx = string.sub(navx,1,val_posd)
												if navx ~= "/" then
													var = "-2"
												end
											end
											if var ~= "-2" and var ~= "0" then
												var = "-2"
												filename = liste[a]
												if fs.isDir(navx.."/"..filename) == true then
													navx = navx.."/"..filename
												else
													repeat
														term.clear()
														term.setCursorPos(1,1)
														print("nav : "..navx.."/"..filename)
														print("exit")
														print("edit")
														print("remove")
														print("copy")
														print("move")
														sleep(0.2)
														if var == "2" then
															term.clear()
															term.setCursorPos(1,1)
															print("nav : "..navx.."/"..filename)
															print("edit")
															var = read()
															shell.run("edit "..navx.."/"..filename)
														elseif var == "3" then
															term.clear()
															term.setCursorPos(1,1)
															print("nav : "..navx.."/"..filename)
															print("remove")
															print("send ok pour suppr ce fichier")
															var = read()
															if var == "ok" then
																fs.delete(navx.."/"..filename)
															end
														elseif var == "4" then
															term.clear()
															term.setCursorPos(1,1)
															print("nav : "..navx.."/"..filename)
															print("copy")
															print("entre la destination")
															var = read()
															print(var)
															print("send ok pour copier ce fichier")
															varr = read()
															if varr == "ok" then
																fs.copy(navx.."/"..filename,var)
															end
														elseif var == "5" then
															term.clear()
															term.setCursorPos(1,1)
															print("nav : "..navx.."/"..filename)
															print("move")
															var = read()
															print(var)
															print("send ok pour deplacer ce fichier")
															varr = read()
															if varr == "ok" then
																fs.move(navx.."/"..filename,var)
															end
														end
													until var == "0"
												end
												var = "-2"
											end
										until var == "0"
										var = "-2"
									end
									if act == "11" then
										shell.run("edit ".."echec")
									end
									if act == "9" then
										shell.run("edit ".."ping")
									end
									if act == "8" then
										mon2.clear()
										mon2.setCursorPos(1,1)
										mon2.write("gate")
										gate_ping = ecr()
										mon2.setCursorPos(1,1)
										mon2.write("id")
										id_ping = tonumber(ecr())
										if id_ping ~= nil then
											repeat
												verif = http.get("http://"..httpdns.."/update/index.php?action=time_sec")
												verif = verif.readAll()
												verif = tonumber(verif)
												tab = {id = id_ping, id_origin = os.getComputerID(),gate = gate_ping, message = {ref = "ping", horaire_e = verif}}
												rednet.send(stargate,tab)
												id, message = rednet.recieve(1.5)
											until message == "recu"
										end
									end
									if act == "2" then
										redstone.setBundledOutput(bSide,colors.combine(redstone.getBundledOutput(bSide),colors.red))
										ecr()
										redstone.setBundledOutput(bSide,colors.subtract(redstone.getBundledOutput(bSide), colors.red))
									end
									if act == "3" then
										redstone.setBundledOutput(bSide,colors.combine(redstone.getBundledOutput(bSide),colors.red))
										arret = true
										act = 0
										repeat
											sleep(1)
											act = act + 1
											if state == true then
												for a = 1, #id_def do
													rednet.send(id_def[a],"arret")
												end
												exit()
											end
										until act > 80
										arret = false
										act = "-1"
									end
									if act == "4" then
										update = true
									end
									if act == "0" then
										mon2.clear()
										mon2.setCursorPos(1,1)
										mon2.write("confirme y/n")
										mon2.setCursorPos(1,19)
										ecr()
										if act == "y" then
											if z == 1 then
												z = zz
												mon2.clear()
												mon2.setCursorPos(1,1)
												mon2.write("vous re-utiliser votre compte")
												sleep(3)
											else
												zz = z
												z = 1
												mon2.clear()
												mon2.setCursorPos(1,1)
												mon2.write("vous utiliser le compte de la banque")
												sleep(3)
											end
										end
									end
									if act == "5" then
										azb = 0
										pos_play = {}
										repeat
											mon2.clear()
											mon2.setCursorPos(1,1)
											player_t = {}
											azd = 0
											for a = 1, #player do
												verif_compte[a] = false
												for adc = 1, #player_c do
													if player[a] == player_c[adc] then
														verif_compte[a] = true
														break
													end
												end
												if verif_compte[a] == false then
													mon2.write(player[a])
													azd = azd + 1
													player_t[azd] = player[a]
													pos_play[azd] = a
												end
											end
											mon2.setCursorPos(1,1)
											azd = 1
											for a = 1, 16 do
												mon2.setCursorPos(15,azd)
												mon2.write(" | ")
												if player_c[a+azb] == nil then
													mon2.write(a+azb.." -  -- nil -- ")
												else
													mon2.write(a+azb.." - "..player_c[a+azb])
												end
												mon2.setCursorPos(35,azd)
												mon2.write(" | ")
												mon2.setBackgroundColor(32768)
												azd = azd + 1
											end
											mon2.setCursorPos(1,18)
											mon2.write("valide-xx--xx or carte-xx")
											act = ecr()
											if string.find(act,"carte-") then
												act = string.sub(act, 7)
												azb = tonumber(act)
												if azb <= 0 then
													azb = 0
												end
											end
											if string.find(act,"valide-") then
												actt = tonumber(string.sub(act, 8,9))
												acttt = tonumber(string.sub(act, 12))
												if actt > 0 and acttt > 0 then
													if player_c[acttt] == nil and player_t[actt] ~= nil then
														player_c[acttt] = player_t[actt]
														verif_compte[pos_play[actt]] = true
													end
												end
											end
										until act == "exit"
										files = fs.open("player","w")
										files.writeLine("player_c = "..textutils.serialize(player_c))
										files.close()
										fs.delete("/"..disk.getMountPath(drive_datac).."/player")
										fs.copy("player","/"..disk.getMountPath(drive_datac).."/player")
										azd = nil
										azb = nil
										pos_play = nil
										uplist = true
									end
									until act == "exit"
									act = "-1"
								end
								if act == "1" then
									for a = 1 , 10 do
										if a+offre_max[z] <= 100 then
											mon2.setCursorPos(1,a+1)
											mon2.write("prix pour "..a)
											mon2.setCursorPos(15,a+1)
											act_p = math.exp(math.log10(a*offre_max[z]))
											act_p = act_p*5000
											act_p = math.floor(act_p)
											mon2.write(act_p)
										end
									end
									mon2.setCursorPos(1,13)
									mon2.write(offre_max[z].."/100")
									mon2.setCursorPos(1,19)
									act = tonumber(ecr())
									if act + offre_max[z] <= 100 and act > 0 then
										act_p = math.exp(math.log10(act*offre_max[z]))
										act_p = act_p*5000
										act_p = math.floor(act_p)
										if compte_coffre[z] >= act_p then
											verif = increment(z,act,nil,nil)
											if verif == true then
												compte_coffre[z] = compte_coffre[z] - act_p
												type_banque_c[#type_banque_c+1] = "plus "..act
												time_date_c[#type_banque_c] = Hour.."/"..day.."/"..mois
												total_c[#type_banque_c] = "-"..act_p
												destinataire_c[#type_banque_c] = "banque"
												time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
												info_c[#type_banque_c] = "na"
												save_histo(z)
												save()
											else
												mon2.clear()
												mon2.setCursorPos(5,5)
												mon2.write("db error")
											end
										else
											mon2.clear()
											mon2.setCursorPos(5,5)
											mon2.write("pas assez sur le compte")
										end
									else
										mon2.clear()
										mon2.setCursorPos(5,5)
										mon2.write("limite de 100 offre maxi")
									end
								end
								if act == "4" then
									mon2.clear()
									mon2.setCursorPos(1,1)
									mon2.write("pc = "..pc_dest[z])
									mon2.setCursorPos(1,3)
									mon2.write("gate = "..gate_dest[z])
									mon2.setCursorPos(1,19)
									act = ecr()
									if act == "pc" then
										mon2.setCursorPos(1,6)
										mon2.write("entrer votre nouvelle ip")
										act = tonumber(ecr())
										if act ~= nil then
											mon2.setCursorPos(1,8)
											mon2.write(act.." - a la place de - "..pc_dest[z])
											mon2.setCursorPos(1,9)
											mon2.write("y/n")
											act = ecr()
											if act == "y" then
												pc_dest[z] = act
											end
										end
									elseif act == "gate" then
										mon2.setCursorPos(1,6)
										mon2.write("entrer votre nouvelle address")
										act = ecr()
										if string.len(act) == 9 then
											mon2.setCursorPos(1,8)
											mon2.write(act.." - a la place de - "..pc_dest[z])
											mon2.setCursorPos(1,9)
											mon2.write("y/n")
											act = ecr()
											if act == "y" then
												gate_dest[z] = act
											end
										end
									end
									save()
								end
								until act == "exit"
								act = "-1"
							end
							if act == "4" then
								line = type_banque_c
								affich_info = 0
								i = 0
								repeat
									mon2.clear()
									mon2.setCursorPos(1,1)
									mon2.write("+---+-------+--------+--------+-----------+---+---+")
									mon2.setCursorPos(1,2)
									mon2.write("| n | type  |  date  | somme  |destination|inf|sup|")
									mon2.setCursorPos(1,3)
									mon2.write("+---+-------+--------+--------+-----------+---+---+")
									ra = 0
									repeat
										ra = ra + 1
										mon2.setCursorPos(1,ra+3)
										mon2.write("|"..ra+i)
										mon2.setCursorPos(5,ra+3)
										if type_banque_c[ra+i] ~= nil then
											mon2.write("|"..type_banque_c[ra+i])
											mon2.setCursorPos(13,ra+3)
											mon2.write("|"..time_date_c[ra+i])
											mon2.setCursorPos(22,ra+3)
											mon2.write("|"..total_c[ra+i])
											mon2.setCursorPos(31,ra+3)
											mon2.write("|"..destinataire_c[ra+i])
											mon2.setCursorPos(43,ra+3)
											mon2.write("| x | x |")
										else
											mon2.write("|       |        |        |           | x | x |")
										end
									until ra > 13
									mon2.setCursorPos(1,18)
									mon2.write("+---+-------+--------+--------+-----------+---+---+")
									mon2.setBackgroundColor(128)
									mon2.setCursorPos(1,19)
									mon2.write("exit")
									mon2.setCursorPos(16,19)
									mon2.write("compte")
									mon2.write(" - ")
									mon2.write("filtre")
									mon2.setBackgroundColor(32768)
									sleep(0,2)
									if act == "compte" then
										mon2.clear()
										mon2.setCursorPos(1,1)
										mon2.write("solde = "..compte_coffre[z])
										mon2.write("")
										mon2.write("pret = "..pret[z])
										mon2.write("")
										mon2.write("nbr d'offre = "..offre_max[z])
										mon2.write("")
										mon2.write("pc commerce = "..pc_dest[z])
										mon2.write("")
										mon2.write("gate commerce = "..gate_dest[z])
										mon2.setCursorPos(1,18)
										act = ecr()
									elseif act == "filtre" then
										mon2.clear()
										mon2.setCursorPos(5,8)
										mon2.write("fonction a venir")
										sleep(2)
									elseif act == "info" then
										mon2.clear()
										mon2.setCursorPos(1,1)
										if type_banque_c[affich_info+i] ~= nil then
											mon2.write("type     = "..type_banque_c[affich_info+i])
											mon2.write("temps    = "..time_date_c[affich_info+i])
											mon2.write("prix     = "..total_c[affich_info+i])
											mon2.write("dest     = "..destinataire_c[affich_info+i])
											if info_c[affich_info+i] ~= nil then
												mon2.write("info     = "..info_c[affich_info+i])
											end
											act = nil
											repeat
												sleep(0.3)
											until act ~= nil
										end
									elseif act == "sup" then
										mon2.clear()
										mon2.setCursorPos(5,8)
										mon2.write("fonction a venir")
										sleep(2)
									end
								until act == "exit"
								act = "-1"
							end
							if act == "7" and z > 1 then
								repeat
									mon2.clear()
									mon2.setCursorPos(12,1)
									mon2.write("1000 coins pour enlever la pluie")
									mon2.setCursorPos(15,2)
									mon2.write("solde :"..compte_coffre[z])
									mon2.setBackgroundColor(128)
									for a = 1, #button do
										mon2.setCursorPos(15,6 + a)
										mon2.write(button[a])
									end
									mon2.setCursorPos(1,19)
									mon2.write("exit")
									mon2.setBackgroundColor(32768)
									sleep(0.2)
									if act == "enlever_pluie" then
										enlevePluie(z)
										act = "exit"
									end
								until act == "exit"
								act = "-1"
							end
							if act == "5" then
								repeat
									mon2.clear()
									mon2.setCursorPos(1,1)
									mon2.setBackgroundColor(128)
									mon2.write("1  - new cert     ")
									mon2.setCursorPos(1,2)
									mon2.write("2  - liste cert   ")
									mon2.setCursorPos(1,19)
									mon2.write("exit")
									mon2.setBackgroundColor(32768)
									sleep(0.2)
									if act == "0" then
										act = ""
										repeat
											mon2.clear()
											mon2.setCursorPos(1,1)
											mon2.setBackgroundColor(128)
											mon2.write("  temps de cycle :")
											if act1 ~= nil then
												mon2.write(act1)
											end
											mon2.setCursorPos(1,3)
											mon2.write("  type abo       :")
											if act2 ~= nil then
												mon2.write(act2)
											end
											mon2.setCursorPos(1,5)
											mon2.write("  prix de depart :")
											if act3 ~= nil then
												mon2.write(act3)
											end
											mon2.setCursorPos(1,7)
											mon2.write("  objet-service  :")
											if act4 ~= nil then
												mon2.write(act4)
											end
											mon2.setCursorPos(1,9)
											mon2.write("  info paiement  :")
											if act5 ~= nil then
												mon2.write(act5)
											end
											mon2.setCursorPos(1,17)
											mon2.write("     valider      ")
											mon2.setCursorPos(1,19)
											mon2.write("exit")
											mon2.setBackgroundColor(32768)
											mon2.setCursorPos(1,14)
											mon2.write(" prix certificat : 5000")
											mon2.setCursorPos(1,15)
											mon2.write(" votre compte    : "..compte_coffre[z])
											sleep(0.2)
											if act == "0" then
												mon2.setCursorPos(21,1)
												mon2.write("                                        ")
												mon2.setCursorPos(21,1)
												act1 = math.floor(tonumber(ecr()))
												if act1 < 1 then
													act1 = nil
												end
											elseif act == "2" then
												mon2.setCursorPos(1,12)
												mon2.write("prix  : fix / variable et/ou bourse")
												mon2.setCursorPos(1,13)
												mon2.write("conso : limit ou libre")
												mon2.setCursorPos(21,3)
												mon2.write("                                        ")
												mon2.setCursorPos(21,3)
												act2 = ecr()
											elseif act == "4" then
												mon2.setCursorPos(21,5)
												mon2.write("                                        ")
												mon2.setCursorPos(21,5)
												act3 = math.floor(tonumber(ecr()))
												if act3 <= 0 then
													act3 = nil
												end
											elseif act == "6" then
												mon2.setCursorPos(21,7)
												mon2.write("                                        ")
												mon2.setCursorPos(21,7)
												act4 = ecr()
											elseif act == "8" then
												mon2.setCursorPos(21,9)
												mon2.write("                                        ")
												mon2.setCursorPos(21,9)
												act5 = ecr()
											end
											if act == "16" then
												if act1 == nil or act2 == nil or act3 == nil or act4 == nil or act5 == nil then
													act = ""
													mon2.clear()
													mon2.setCursorPos(1,1)
													mon2.write("un des criteres est encore vide")
													sleep(3)
												end
											end
											if act == "16" and compte_coffre[z] >= 5000 then
												repeat
													used = false
													alphabet = '4A1B81CD4EF8G3HI5JK5L6M7N7OP0QR9S3T6UVW02X9YZ2'
													mdp_new = ""
													for a = 1, 8 do
														rand = math.random(string.len(alphabet))
														rand = string.sub(alphabet,rand,rand)
														mdp_new = mdp_new..rand
													end
													for zad = 1, #abo do
														if abo[zad].num == mdp_new then
															used = true
															break
														end
													end
													alphabet = nil
												until used == false
												cert[#cert+1].num = mdp_new
												cert[#cert].player = player[z]
												cert[#cert].mod = 1
												cert[#cert].date = act1
												cert[#cert].type = act2
												cert[#cert].tarif = act3
												cert[#cert].objet = act4
												cert[#cert].date_end = 0
												cert[#cert].info = act5
												cert[#cert].rapport = -5000
												compte_coffre[z] = compte_coffre[z] - 5000
												type_banque_c[#type_banque_c+1] = "newcert"
												time_date_c[#type_banque_c] = Hour.."h"..Minute.." "..day
												total_c[#type_banque_c] = "-5000"
												destinataire_c[#type_banque_c] = "banque"
												time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
												info_c[#type_banque_c] = "le certificat n "..mdp_new.." de "..player[z].." est maintenant actif"
												save_histo(z)
												rednet.send(serveur_news,"news")
												sleep(0.5)
												rednet.send(serveur_news,player[z].." a obtenu un nouveau certificat")
												save()
												files = fs.open("cert_abo", "w")
												files.writeLine("cert = "..textutils.serialize(cert))
												files.writeLine("abo = "..textutils.serialize(abo))
												files.close()
												mon2.clear()
												mon2.setCursorPos(1,1)
												mon2.write("certificat creer")
												sleep(5)
											elseif act == "y" and compte_coffre[z] < 5000 then
												mon2.clear()
												mon2.setCursorPos(1,1)
												mon2.write("pas assez sur le compte")
												sleep(5)
											end
										until act == "exit"
										act = "-1"
										act1 = nil
										act2 = nil
										act3 = nil
										act4 = nil
									end
									if act == "1" then
										i = 0
										cert_t = {}
										for a = 1, #cert do
											if player[z] == cert[a].player then
												i = i + 1
												cert_t[i] = cert[a]
											end
										end
										i = 0
										line = cert_t
										affich_info = 0
										repeat
											mon2.clear()
											mon2.setCursorPos(1,1)
											mon2.write("+---+-------+--------+--------+-----------+---+---+")
											mon2.setCursorPos(1,2)
											mon2.write("| n | type  |  date  | somme  |   objet   |inf|sup|")
											mon2.setCursorPos(1,3)
											mon2.write("+---+-------+--------+--------+-----------+---+---+")
											ra = 0
											repeat
												ra = ra + 1
												mon2.setCursorPos(1,ra+3)
												mon2.write("|"..ra+i)
												mon2.setCursorPos(5,ra+3)
												if cert_t[ra+i] ~= nil then
													if cert_t[ra+i].type ~= nil then
														mon2.write("|"..cert_t[ra+i].type)
														mon2.setCursorPos(13,ra+3)
														mon2.write("|"..cert_t[ra+i].date)
														mon2.setCursorPos(22,ra+3)
														mon2.write("|"..cert_t[ra+i].tarif)
														mon2.setCursorPos(31,ra+3)
														mon2.write("|"..cert_t[ra+i].objet)
														mon2.setCursorPos(43,ra+3)
														mon2.write("| x | x |")
													else
														mon2.write("|       |        |        |           | x | x |")
													end
												else
													mon2.write("|       |        |        |           | x | x |")
												end
											until ra > 13
											mon2.setCursorPos(1,18)
											mon2.write("+---+-------+--------+--------+-----------+---+---+")
											mon2.setBackgroundColor(128)
											mon2.setCursorPos(1,19)
											mon2.write("exit")
											mon2.setCursorPos(25,19)
											mon2.write("filtre")
											mon2.setBackgroundColor(32768)
											sleep(0,2)
											if act == "filtre" then
												mon2.clear()
												mon2.setCursorPos(5,8)
												mon2.write("fonction a venir")
												sleep(2)
											elseif act == "info" then
												mon2.clear()
												mon2.setCursorPos(1,1)
												if cert_t[affich_info+i].num ~= nil then
													mon2.write("num cert = "..cert_t[affich_info+i].num)
													mon2.setCursorPos(1,2)
													mon2.write("type     = "..cert_t[affich_info+i].type)
													mon2.setCursorPos(1,3)
													mon2.write("temps    = "..cert_t[affich_info+i].date)
													mon2.setCursorPos(1,4)
													mon2.write("prix     = "..cert_t[affich_info+i].tarif)
													mon2.setCursorPos(1,5)
													mon2.write("objet    = "..cert_t[affich_info+i].objet)
													mon2.setCursorPos(1,6)
													mon2.write("dernier  = "..cert_t[affich_info+i].date_end)
													mon2.setCursorPos(1,7)
													mon2.write("rapport  = "..cert_t[affich_info+i].rapport)
													mon2.setCursorPos(1,8)
													mon2.write("info     = "..cert_t[affich_info+i].info)
													mon2.setCursorPos(5,10)
													mon2.write("modif : fonction a venir")
													act = nil
													repeat
														sleep(0.3)
													until act ~= nil
												end
												--[[
													rednet.send(serveur_news,"news")
													sleep(0.5)
													rednet.send(serveur_news,"le certificat n"..numero.." de "..player[z].." a ete modifier")
												]]--
											elseif act == "sup" then
												mon2.clear()
												mon2.setCursorPos(1,1)
												if cert_t[affich_info+i].num ~= nil then
													mon2.write("num cert = "..cert_t[affich_info+i].num)
													mon2.setCursorPos(1,2)
													mon2.write("type     = "..cert_t[affich_info+i].type)
													mon2.setCursorPos(1,3)
													mon2.write("temps    = "..cert_t[affich_info+i].date)
													mon2.setCursorPos(1,4)
													mon2.write("prix     = "..cert_t[affich_info+i].tarif)
													mon2.setCursorPos(1,5)
													mon2.write("objet    = "..cert_t[affich_info+i].objet)
													mon2.setCursorPos(1,6)
													mon2.write("dernier  = "..cert_t[affich_info+i].date_end)
													mon2.setCursorPos(1,7)
													mon2.write("rapport  = "..cert_t[affich_info+i].rapport)
													mon2.setCursorPos(1,8)
													mon2.write("info     = "..cert_t[affich_info+i].info)
													mon2.setCursorPos(1,19)
													act = ecr()
													if act == "y" then
														for ap = 1, #cert do
															if cert[ap].num == cert_t[affich_info+i].num then
																type_banque_c[#type_banque_c+1] = "certsup"
																time_date_c[#type_banque_c] = Hour.."h"..Minute.." "..day
																total_c[#type_banque_c] = "0"
																destinataire_c[#type_banque_c] = "banque"
																time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
																info_c[#type_banque_c] = "le certificat n "..cert[ap].num.." de "..player[z].." sera supprimer dans 3 jours"
																save_histo(z)
																cert[ap].mod = -4
																cert[ap].date = 1440
																files = fs.open("cert_abo", "w")
																files.writeLine("cert = "..textutils.serialize(cert))
																files.writeLine("abo = "..textutils.serialize(abo))
																files.close()
																mon2.clear()
																mon2.setCursorPos(1,1)
																mon2.write("le certificat sera supprimer dans 3 jours")
																rednet.send(serveur_news,"news")
																sleep(0.5)
																rednet.send(serveur_news,"le certificat n "..cert[ap].num.." de "..player[z].." sera supprimer dans 3 jours")
																sleep(5)
															end
														end
													end
												end
											end
										until act == "exit"
										act = "-1"
										cert_t = nil
									end
								until act == "exit"
								act = "-1"
							end
							if act == "6" and z > 1 then
								repeat
									mon2.clear()
									mon2.setCursorPos(1,1)
									mon2.setBackgroundColor(128)
									mon2.write("1  - new abos     ")
									mon2.setCursorPos(1,2)
									mon2.write("2  - liste abo    ")
									mon2.setCursorPos(1,19)
									mon2.write("exit")
									mon2.setBackgroundColor(32768)
									sleep(0.2)
									if act == "0" then
										i = 0
										cert_t = {}
										for ra = 1, #cert do
											used = false
											for a = 1, #abo_perso_c do
												if abo_perso_c[a].num_cert == cert[ra].num then
													used = true
												end
												if cert[ra+i].mod ~= 1 then
													used = true
												end
												if cert[ra+i].player == player[z] then
													used = true
												end
											end
											if used == false then
												i = i + 1
												cert_t[i] = cert[ra]
											end
										end
										i = 0
										line = cert_t
										affich_info = 0
										repeat
											mon2.clear()
											mon2.setCursorPos(1,1)
											mon2.write("+---+-------+--------+--------+-----------+---+---+")
											mon2.setCursorPos(1,2)
											mon2.write("| n | type  |  date  | somme  |   objet   |inf|abo|")
											mon2.setCursorPos(1,3)
											mon2.write("+---+-------+--------+--------+-----------+---+---+")
											ra = 0
											repeat
												ra = ra + 1
												mon2.setCursorPos(1,ra+3)
												mon2.write("|"..ra+i)
												mon2.setCursorPos(5,ra+3)
												if cert_t[ra+i].type ~= nil then
													mon2.write("|"..cert_t[ra+i].type)
													mon2.setCursorPos(13,ra+3)
													mon2.write("|"..cert_t[ra+i].date)
													mon2.setCursorPos(22,ra+3)
													mon2.write("|"..cert_t[ra+i].tarif)
													mon2.setCursorPos(31,ra+3)
													mon2.write("|"..cert_t[ra+i].objet)
													mon2.setCursorPos(43,ra+3)
													mon2.write("| x | x |")
												else
													mon2.write("|       |        |        |           | x | x |")
												end
											until ra > 13
											mon2.setCursorPos(1,18)
											mon2.write("+---+-------+--------+--------+-----------+---+---+")
											mon2.setBackgroundColor(128)
											mon2.setCursorPos(1,19)
											mon2.write("exit")
											mon2.setCursorPos(25,19)
											mon2.write("filtre")
											mon2.setBackgroundColor(32768)
											sleep(0,2)
											if act == "filtre" then
												mon2.clear()
												mon2.setCursorPos(5,8)
												mon2.write("fonction a venir")
												sleep(2)
											elseif act == "info" then
												mon2.clear()
												mon2.setCursorPos(1,1)
												if cert_t[affich_info+i].num ~= nil then
													mon2.write("proprio  = "..cert_t[affich_info+i].player)
													mon2.setCursorPos(1,2)
													mon2.write("type     = "..cert_t[affich_info+i].type)
													mon2.setCursorPos(1,3)
													mon2.write("temps    = "..cert_t[affich_info+i].date)
													mon2.setCursorPos(1,4)
													mon2.write("prix     = "..cert_t[affich_info+i].tarif)
													mon2.setCursorPos(1,5)
													mon2.write("objet    = "..cert_t[affich_info+i].objet)
													mon2.setCursorPos(1,6)
													mon2.write("info     = "..cert_t[affich_info+i].info)
													act = nil
													repeat
														sleep(0.3)
													until act ~= nil
												end
											elseif act == "sup" then -- s'abonner
												mon2.clear()
												mon2.setCursorPos(1,1)
												if cert_t[affich_info+i].player ~= nil then
													mon2.write("proprio  = "..cert_t[affich_info+i].player)
													mon2.setCursorPos(1,2)
													mon2.write("type     = "..cert_t[affich_info+i].type)
													mon2.setCursorPos(1,3)
													mon2.write("temps    = "..cert_t[affich_info+i].date)
													mon2.setCursorPos(1,4)
													mon2.write("prix     = "..cert_t[affich_info+i].tarif)
													mon2.setCursorPos(1,5)
													mon2.write("objet    = "..cert_t[affich_info+i].objet)
													mon2.setCursorPos(1,6)
													mon2.write("info     = "..cert_t[affich_info+i].info)
													mon2.setCursorPos(1,19)
													act = ecr()
													if act == "y" then
														repeat
															used = false
															alphabet = '4A1B81CD4EF8G3HI5JK5L6M7N7OP0QR9S3T6UVW02X9YZ2'
															mdp_new = ""
															for a = 1, 8 do
																rand = math.random(string.len(alphabet))
																rand = string.sub(alphabet,rand,rand)
																mdp_new = mdp_new..rand
															end
															for zad = 1, #abo do
																if abo[zad].num == mdp_new then
																	used = true
																	break
																end
															end
															alphabet = nil
														until used == false
														abo[#abo+1].num_cert = cert_t[affich_info+i].num
														abo[#abo].num = mdp_new
														abo[#abo].player = player[z]
														abo[#abo].mod = 0
														abo[#abo].date = cert_t[affich_info+i].date + cert_t[affich_info+i].date_end
														abo_perso_c[#abo_perso_c+1].num_cert = cert_t[affich_info+i].num_cert
														abo_perso_c[#abo_perso_c].num = cert_t[affich_info+i].num
														abo_perso_c[#abo_perso_c].type = cert_t[affich_info+i].type
														abo_perso_c[#abo_perso_c].date = cert_t[affich_info+i].date
														abo_perso_c[#abo_perso_c].tarif = cert_t[affich_info+i].tarif
														abo_perso_c[#abo_perso_c].objet = cert_t[affich_info+i].objet
														abo_perso_c[#abo_perso_c].info = cert_t[affich_info+i].info
														abo_perso_c[#abo_perso_c].proprio = cert_t[affich_info+i].player
														type_banque_c[#type_banque_c+1] = "abo"
														time_date_c[#type_banque_c] = Hour.."h"..Minute.." "..day
														total_c[#type_banque_c] = "0"
														destinataire_c[#type_banque_c] = "banque"
														time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
														info_c[#type_banque_c] = "votre abonnement n "..mdp_new.." debutera a la prochaine actualisation"
														save_histo(z)
														files = fs.open("cert_abo", "w")
														files.writeLine("cert = "..textutils.serialize(cert))
														files.writeLine("abo = "..textutils.serialize(abo))
														files.close()
														mon2.clear()
														mon2.setCursorPos(1,1)
														mon2.write("votre abonnement n "..mdp_new.." debutera a la prochaine actualisation")
														sleep(5)
													end
												end
											end
										until act == "exit"
										act = "-1"
										cert_t = nil
									end
									if act == "1" then
										line = abo_perso_c
										i = 0
										affich_info = 0
										repeat
											mon2.clear()
											mon2.setCursorPos(1,1)
											mon2.write("+---+-------+--------+--------+-----------+---+---+")
											mon2.setCursorPos(1,2)
											mon2.write("| n | type  |  date  | somme  |   objet   |inf|sup|")
											mon2.setCursorPos(1,3)
											mon2.write("+---+-------+--------+--------+-----------+---+---+")
											ra = 0
											repeat
												ra = ra + 1
												mon2.setCursorPos(1,ra+3)
												mon2.write("|"..ra+i)
												mon2.setCursorPos(5,ra+3)
												if abo_perso_c[ra+i] ~= nil then
													if abo_perso_c[ra+i].type ~= nil then
														mon2.write("|"..abo_perso_c[ra+i].type)
														mon2.setCursorPos(13,ra+3)
														mon2.write("|"..abo_perso_c[ra+i].date)
														mon2.setCursorPos(22,ra+3)
														mon2.write("|"..abo_perso_c[ra+i].tarif)
														mon2.setCursorPos(31,ra+3)
														mon2.write("|"..abo_perso_c[ra+i].objet)
														mon2.setCursorPos(43,ra+3)
														mon2.write("| x | x |")
													else
														mon2.write("|       |        |        |           | x | x |")
													end
												else
													mon2.write("|       |        |        |           | x | x |")
												end
											until ra > 13
											mon2.setCursorPos(1,18)
											mon2.write("+---+-------+--------+--------+-----------+---+---+")
											mon2.setBackgroundColor(128)
											mon2.setCursorPos(1,19)
											mon2.write("exit")
											mon2.setCursorPos(25,19)
											mon2.write("filtre")
											mon2.setBackgroundColor(32768)
											sleep(0,2)
											if act == "filtre" then
												mon2.clear()
												mon2.setCursorPos(5,8)
												mon2.write("fonction a venir")
												sleep(2)
											elseif act == "info" then
												mon2.clear()
												mon2.setCursorPos(1,1)
												if abo_perso_c[affich_info+i].num_cert ~= nil then
													mon2.write("proprio  = "..abo_perso_c[affich_info+i].proprio)
													mon2.setCursorPos(1,2)
													mon2.write("num_cert = "..abo_perso_c[affich_info+i].num_cert)
													mon2.setCursorPos(1,3)
													mon2.write("num      = "..abo_perso_c[affich_info+i].num)
													mon2.setCursorPos(1,4)
													mon2.write("type     = "..abo_perso_c[affich_info+i].type)
													mon2.setCursorPos(1,5)
													mon2.write("temps    = "..abo_perso_c[affich_info+i].date)
													mon2.setCursorPos(1,6)
													mon2.write("prix     = "..abo_perso_c[affich_info+i].tarif)
													mon2.setCursorPos(1,7)
													mon2.write("objet    = "..abo_perso_c[affich_info+i].objet)
													mon2.setCursorPos(1,8)
													mon2.write("info     = "..abo_perso_c[affich_info+i].info)
													act = nil
													repeat
														sleep(0.3)
													until act ~= nil
												end
											elseif act == "sup" then
												mon2.clear()
												mon2.setCursorPos(1,1)
												if abo_perso_c[affich_info+i].num_cert ~= nil then
													mon2.write("proprio  = "..abo_perso_c[affich_info+i].proprio)
													mon2.setCursorPos(1,2)
													mon2.write("num_cert = "..abo_perso_c[affich_info+i].num_cert)
													mon2.setCursorPos(1,3)
													mon2.write("num      = "..abo_perso_c[affich_info+i].num)
													mon2.setCursorPos(1,4)
													mon2.write("type     = "..abo_perso_c[affich_info+i].type)
													mon2.setCursorPos(1,5)
													mon2.write("temps    = "..abo_perso_c[affich_info+i].date)
													mon2.setCursorPos(1,6)
													mon2.write("prix     = "..abo_perso_c[affich_info+i].tarif)
													mon2.setCursorPos(1,7)
													mon2.write("objet    = "..abo_perso_c[affich_info+i].objet)
													mon2.setCursorPos(1,8)
													mon2.write("info     = "..abo_perso_c[affich_info+i].info)
													mon2.setCursorPos(1,19)
													act = ecr()
													if act == "y" then
														for ap = 1, #abo do
															if abo[ap].num == abo_perso_c[affich_info+i].num then
																type_banque_c[#type_banque_c+1] = "arretabo"
																time_date_c[#type_banque_c] = Hour.."h"..Minute.." "..day
																total_c[#type_banque_c] = "0"
																destinataire_c[#type_banque_c] = "banque"
																time_c[#type_banque_c] = Hour.."/"..dday.."/"..mmois
																info_c[#type_banque_c] = "votre abonnement n "..abo[ap].num.." n'arretera apres 3 actualisation"
																save_histo(z)
																abo[ap].mod = -3
																files = fs.open("cert_abo", "w")
																files.writeLine("cert = "..textutils.serialize(cert))
																files.writeLine("abo = "..textutils.serialize(abo))
																files.close()
																mon2.clear()
																mon2.setCursorPos(1,1)
																mon2.write("votre abonnement n "..abo[ap].num.." n'arretera apres 3 actualisation")
																sleep(5)
															end
														end
													end
												end
											end
										until act == "exit"
										act = "-1"
									end
								until act == "exit"
								act = "-1"
							end
						until act == "exit"
						type_banque_c = {}
						time_c = {}
						time_date_c = {}
						total_c = {}
						destinataire_c = {}
						abo_c = {}
						cert_c = {}
						histo_cert_c = {}
						histo_abo_c = {}
						abo_perso_c = {}
					end
				end
			end
			if act == "1" then
				mon2.clear()
				mon2.setCursorPos(1,1)
				mon2.write("new")
				mon2.setCursorPos(1,3)
				mon2.write("utilise le capteur d'empreinte")
				libre = false
				new = #player + 1
				name = nil
				repeat
					sleep(0.5)
				until name ~= nil
				for b = 1, #player do
					if name == player[b] then
						name = nil
					end
				end
				if name ~= nil then
					if #player <= #drive_datac*5 then
						repeat
							mon2.clear()
							mon2.setCursorPos(1,1)
							mon2.write("ecrit ton pseudo")
							actpl = ecr()
							for a = 1, #player do
								if actpl == player[a] then
									mon2.write("pseudo deja utiliser")
									actpl = "0"
									sleep(2)
									break
								end
							end
						until actpl ~= "0"
					else
						actpl = "exit"
						mon2.setCursorPos(1,1)
						mon2.write("error")
						mon2.write("plus de place disk")
						sleep(5)
					end
					if actpl ~= "exit" and actpl ~= "0" then
						repeat
							mon2.clear()
							mon2.setCursorPos(1,1)
							mon2.write("set le mdp pour la banque")
							mon2.setCursorPos(1,19)
							key_text = ecr()
						until string.len(key_text) > 1
						player[new] = actpl
						mdp[new] = crypto.hash("SHA1",key_text)
						compte_coffre[new] = 0
						pret[new] = 0
						mdp_auto[new] = crypto.hash("SHA1",key_text.."-auto")
						offre_max[new] = 10
						pc_dest[new] = 0
						gate_dest[new] = 0
						verif_compte[new] = false
						verif = increment(new,10,false,nil)
						if verif == true then
							verif, err = http.get("http://"..httpdns.."/update/site.php?action=new&id="..player[new].."&mdp="..mdp[new].."&banque="..mdp[1].."&compte="..compte_coffre[new])
							rednet.send(serveur_news,"new_player")
							sleep(0.6)
							rednet.send(serveur_news,actpl)
							sleep(0.6)
							rednet.send(serveur_news,key_text)
							rand = nil
							biolock.learn(actpl,name,3)
							pub_n, priv_n = crypto.generateKeyPair("RSA", 512)
							pub[new] = pub_n.encode()
							priv[new] = priv_n.encode()
							pub_d[new] = crypto.decodeKey("RSA", pub[new])
							priv_d[new] = crypto.decodeKey("RSA", priv[new])
							a = new/5
							a = math.ceil(a)
							file = fs.open("/"..disk.getMountPath(drive_datac[a]).."/"..player[new].."-relever", "w")
							file.writeLine("type_banque = {}")
							file.writeLine("time_date = {}")
							file.writeLine("total = {}")
							file.writeLine("destinataire = {}")
							file.writeLine("time = {}")
							file.writeLine("info = {}")
							file.close()
							file = fs.open("/"..disk.getMountPath(drive_datac[a]).."/"..player[new].."-histo-cert_abo", "w")
							file.writeLine("abo_perso = {}")
							file.close()
							save()
							mon2.setCursorPos(5,5)
							mon2.write("compte creer")
						else
							mon2.clear()
							mon2.setCursorPos(5,5)
							mon2.write("db error")
						end
					end
				end
				shell.run(address)
			end
		sleep(1)
	end
end
function mouse()
	while true do
		local e, side, x, y = os.pullEvent("monitor_touch")
		if x < 19 and x > 0 and y > 0 and y < 2 then
			act = "0"
		end
		if x < 19 and x > 0 and y > 1 and y < 3 then
			act = "1"
		end
		if x < 19 and x > 0 and y > 2 and y < 4 then
			act = "2"
		end
		if x < 19 and x > 0 and y > 3 and y < 5 then
			act = "3"
		end
		if x < 19 and x > 0 and y > 4 and y < 6 then
			act = "4"
		end
		if x < 19 and x > 0 and y > 5 and y < 7 then
			act = "5"
		end
		if x < 19 and x > 0 and y > 6 and y < 8 then
			act = "6"
		end
		if x < 19 and x > 0 and y > 7 and y < 9 then
			act = "7"
		end
		if x < 19 and x > 0 and y > 8 and y < 10 then
			act = "8"
		end
		if x < 19 and x > 0 and y > 9 and y < 11 then
			act = "9"
		end
		if x < 19 and x > 0 and y > 10 and y < 12 then
			act = "10"
		end
		if x < 19 and x > 0 and y > 11 and y < 13 then
			act = "11"
		end
		if x < 19 and x > 0 and y > 12 and y < 14 then
			act = "12"
		end
		if x < 19 and x > 0 and y > 13 and y < 15 then
			act = "13"
		end
		if x < 19 and x > 0 and y > 14 and y < 16 then
			act = "14"
		end
		if x < 19 and x > 0 and y > 15 and y < 17 then
			act = "15"
		end
		if x < 19 and x > 0 and y > 16 and y < 18 then
			act = "16"
		end
		if x < 19 and x > 0 and y > 17 and y < 19 then
			act = "17"
		end
		if x < 5 and x > 0 and y > 18 and y < 21 then
			act = "exit"
		end
		if x > 14 and x < 26 and y > 5 and y < 11 then
			act = "enlever_pluie"
		end
		if x < 22 and x > 15 and y > 18 and y < 20 then
			act = "compte"
		end
		if x < 31 and x > 24 and y > 18 and y < 20 then
			act = "filtre"
		end
		if x < 47 and x > 43 and y > 3 and y < 18 then
			act = "info"
			affich_info = y-3
		end
		if x < 51 and x > 47 and y > 3 and y < 18 then
			act = "sup"
			affich_info = y-3
		end
		if x < 29 and x > 21 and y > 14 and y < 16 then
			act = "valider"
		end
		if x < 40 and x > 15 and y > 7 and y < 11 then
			ac = 0
			for a = 0, 25, 5 do
				ac = ac + 1
				if x < 15+a+5 and x > 15+a then
					if y < 9 then
						piece_retour[ac] = piece_retour[ac] + 1
					elseif y > 9 then
						if piece_retour[ac] > 0 then
							piece_retour[ac] = piece_retour[ac] - 1
						end
					end
				end
			end
		end
		sleep(0.1)
	end
end
function rednet_receive()
	while true do
		id, message, protocole = rednet.receive()
		rednet.send(id,"recu")
		if type(message) == "table" and protocole == "banque" then
			double = false
			if message.init ~= nil then
				for a = 1, #repinit do
					if message.init == repinit[a] then
						repinited[a] = "loaded"
					end
				end
			end
			if message.message.routeur == nil and id ~= routeur then
				double = true
			elseif message.message.routeur == "error" and id ~= routeur then
				echec[#echec+1] = message
				file = fs.open("echec", "w")
				file.writeLine("echec = "..textutils.serialize(echec))
				file.close()
			end
			if message.message.n == nil then
				double = true
			end
			if message.message.ref == nil then
				double = true
			else
				if message.message.ref == "ping" and message.message.horaire_e ~= nil and message.gate_origin ~= nil and message.id_origin ~= nil then
					sleep(1)
					message.message.ref = "ping_retour"
					message.gate = message.gate_origin
					message.id = message.id_origin
					verif = http.get("http://"..httpdns.."/update/index.php?action=time_sec")
					verif = verif.readAll()
					verif = tonumber(verif)
					message.message.horaire_r = verif
					message.message.horaire_er = verif - message.message.horaire_e
					rednet.send(id,message)
				elseif message.message.ref == "ping_retour" and message.message.horaire_e ~= nil and message.gate_origin ~= nil and message.id_origin ~= nil and message.message.horaire_r ~= nil and message.message.horaire_er ~= nil then
					sleep(1)
					verif = http.get("http://"..httpdns.."/update/index.php?action=time_sec")
					verif = verif.readAll()
					verif = tonumber(verif)
					message.message.horaire_re = verif - message.message.horaire_r
					file = fs.open("ping","a")
					file.writeLine("ping -id "..message.message.gate_origin.." -gate "..message.message.id_origin)
					message.message.horaire_er = message.message.horaire_er/60
					message.message.horaire_re = message.message.horaire_re/60
					file.writeLine("e --> r = "..message.message.horaire_er.." m")
					file.writeLine("r --> e = "..message.message.horaire_re.." m")
					file.close()
					message = nil
				elseif message.message.ref == "pluie_clear" and message.message.player ~= nil and message.message.mdp ~= nil and message.gate_origin ~= nil and message.id_origin ~= nil then
					for a = 1, #player do
						if player[a] == message.message.player then
							if verif_compte[a] == true then
								mdp_carte2 = priv_d[a].decrypt("RSA",message.message.mdp)
								if mdp_carte2 == mdp[a] then
									enlevePluie(a, true)
								end 
							end
						end
					end
					message = nil
				elseif message.message.ref == "abo" and message.message.cert ~= nil and message.message.player ~= nil and message.message.data ~= nil and message.message.mdp ~= nil and message.gate_origin ~= nil and message.id_origin ~= nil then
					data = message.message.data
					data_cert = nil
					gain = 0
					zac = nil
					for ac = 1, #cert do
						if cert[ac].num == message.message.cert then
							if cert[ac].player == message.message.player then
								data_cert = cert[ac]
								for ac = 1, #player do
									if message.message.player == player[ac] then
										message.message.mdp = priv_d[ac].decrypt("RSA",message.message.mdp)
										if message.message.mdp == mdp[ac] then
											zac = ac
										end
										break
									end
								end
							end
							break
						end
					end
					if zac ~= nil then
						ax = 0
						ay = 0
						stop_player = {}
						stop_num = {}
						start_player = {}
						start_num = {}
						for a = 1, #data do
							for af = 1, #abo do
								if message.message.cert == abo[af].num_cert then
									if abo[af].mod == -3 then
										ax = ax + 1
										stop_player[ax] = abo[af].player
										stop_num[ax] = abo[af].num
									end
									if abo[af].mod == 0 then
										ay = ay + 1
										abo[af].mod = 1
										start_player[ay] = abo[af].player
										start_num[ay] = abo[af].num
									end
								end
								sleep(0.01)
								if abo[af].num == data[a].contrat then
									for ag = 1, #player do
										if abo[af].player == player[ag] then
											za = ag/5
											za = math.ceil(za)
											shell.run("/"..disk.getMountPath(drive_datac[za]).."/"..player[ag].."-relever")
											shell.run("/"..disk.getMountPath(drive_datac[za]).."/"..player[ag].."-histo-cert_abo")
											for ad = 1, #abo_perso do
												data[a].tarif = math.ceil(tonumber(data[a].tarif))
												if abo_perso[ad].num == abo[af].num and abo[af].num_cert == data_cert.num then
													date_t = Hour + data_cert.date
													if date_t > 23 then
														date_t = date_t - 24
													end
													if abo[af].date <= date_t then
														abo[af].date = abo[af].date + data_cert.date
														type_banque[#type_banque+1] = "aboactu"
														time_date[#type_banque] = Hour.."h"..Minute.." "..day.."/"..mois
														total[#type_banque] = "-"..data[a].tarif
														destinataire[#type_banque] = "banque"
														time[#type_banque] = Hour.."/"..day.."/"..mois
														info[#type_banque] = data[a].debit
														compte_coffre[a] = compte_coffre[a] - data[a].tarif
														if compte_coffre[a] < 0 then
															abo[af].mod = -3
															ax = ax + 1
															stop_player[ax] = abo[af].player
															stop_num[ax] = abo[af].num
														end
														gain = gain + data[a].tarif
														save()
														save_histo(ag, true)
													end
													break
												end
											end
											if abo[af].mod < 0 then
												abo[af].mod = abo[af].mod + 1
												if abo[af].mod == 0 then
													for ac = 1, #player do
														if abo[af].player == player[ac] then
															za = ac/5
															za = math.ceil(za)
															shell.run("/"..disk.getMountPath(drive_datac[za]).."/"..player[ac].."-relever")
															shell.run("/"..disk.getMountPath(drive_datac[za]).."/"..player[ac].."-histo-cert_abo")
															for ad = 1, #abo_perso do
																if abo_perso[ad].num == abo[af].num then
																	type_banque[#type_banque+1] = "fin_abo"
																	time_date[#type_banque] = Hour.."h"..Minute.." "..day.."/"..mois
																	total[#type_banque] = "0"
																	destinataire[#type_banque] = "banque"
																	time[#type_banque] = Hour.."/"..day.."/"..mois
																	info[#type_banque] = "na"
																	save_histo(ac, true)
																	abo_perso[ad] = nil
																	break
																end
															end
															break
														end
													end
													abo[af] = nil
												end
											end
											break
										end
									end
									break
								end
							end
						end
						za = zac/5
						za = math.ceil(za)
						shell.run("/"..disk.getMountPath(drive_datac[za]).."/"..player[zac].."-relever")
						shell.run("/"..disk.getMountPath(drive_datac[za]).."/"..player[zac].."-histo-cert_abo")
						type_banque[#type_banque+1] = "gain"
						time_date[#type_banque] = Hour.."h"..Minute.." "..day.."/"..mois
						total[#type_banque] = "+"..gain
						destinataire[#type_banque] = "banque"
						time[#type_banque] = Hour.."/"..day.."/"..mois
						info[#type_banque] = "na"
						save_histo(zac, true)
						id_carte = priv_d[zac].encrypt("RSA",mdp[zac])
						tab = {id = message.id_origin,gate = message.gate_origin, message = {ref = "gain", cert = message.message.cert, stop_player = stop_player, stop_num = stop_num, start_player = start_player, start_num = start_num, n = gain, mdp = id_carte, horaire = os.clock()}}
						renvoi_tampo[#renvoi_tampo+1] = tab
						if cert[a].mod < 0 then
							cert[a].mod = cert[a].mod + 1
							if cert[a].mod == -3 then
								sleep(0.01)
								tab = {id = message.id_origin,gate = message.gate_origin, message = {ref = "fin", n = -3, cert = message.message.cert, mdp = id_carte, horaire = os.clock()}}
								renvoi_tampo[#renvoi_tampo+1] = tab
							end
						end
						file = fs.open("renvoi", "w")
						file.writeLine("renvoi_tampo = "..textutils.serialize(renvoi_tampo))
						file.close()
						files = fs.open("cert_abo", "w")
						files.writeLine("cert = "..textutils.serialize(cert))
						files.writeLine("abo = "..textutils.serialize(abo))
						files.close()
					end
					message = nil
				end
			end
			client = nil
			vendeur = nil
			if message.message.player1 == nil or message.message.player2 == nil then
				double = true
			else
				for a = 1, #player do
					if player[a] == message.message.player1 then
						client = a
					end
					if player[a] == message.message.player2 then
						vendeur = a
					end
				end
			end
			if message.message.horaire == nil then
				double = true
			end
			if message.message.mdp == nil then
				double = true
			end
			if message.gate_origin == nil then
				double = true
			end
			if message.id_origin == nil then
				double = true
			end
			if message.message.type == nil then
				double = true
			end
			if message.id == nil then
				double = true
			end
			if message.gate == nil then
				double = true
			end
			if double == false then
				if message.message.routeur == false then -- commande
					commande_unique(message,client,vendeur)
				end
				if message.message.routeur == true and id ~= routeur then -- commande effectuer
					double = false
					for a = 1, #demande_tampo do
						if message.message.player2 == demande_tampo[a].message.player2 then
							if message.message.ref == demande_tampo[a].message.ref then
								if message.message.n == demande_tampo[a].message.n then
									if message.message.player1 == demande_tampo[a].message.player1 then
										double = true
										break
									end
								end
							end
						end
					end
					if double == false then
					for a = 1, #attente_l do
						if message.message.ref == attente_l[a].message.ref then
							if message.message.n == attente_l[a].message.n then
								if message.message.player1 == attente_l[a].message.player1 then
									if message.message.player2 == attente_l[a].message.player2 then
										mdp_carte2 = priv_d[vendeur].decrypt("RSA",message.message.mdp)
										if mdp_carte2 == mdp[vendeur] then
										attente_l[a].gate = attente_l[a].gate_origin
										attente_l[a].id = attente_l[a].id_origin
										demande_tampo[#demande_tampo+1] = attente_l[a]
										attente_l[a] = nil
										att_1 = 0
										att_2 = 0
										att_3 = 0
										at = 1
										ati = 0
										repeat
											att_1 = attente_l[at]
											att_2 = att_1
											att_3 = att_2
											if att_1 ~= nil then
												ati = ati + 1
												attente_l[ati] = att_1
											end
											at = at + 1
										until att_1 == nil and att_2 == nil and att_3 == nil
										file = fs.open("commande", "w")
										file.writeLine("demande_tampo = "..textutils.serialize(demande_tampo))
										file.close()
										file = fs.open("attente", "w")
										file.writeLine("attente_l = "..textutils.serialize(attente_l))
										file.close()
										rapport_vendeur(false, vendeur, client)
										rapport_client(false, client, vendeur)
										end
									end
								end
							end
						end
					end
					end
				elseif message.message.routeur == true and id == routeur then -- commande transferer
					time_out = 0
					rapport_vendeur(true, vendeur, client)
					rapport_client(true, client, vendeur)
					message.message.horaire = os.clock()
					for a = 1, #player do
						if player[a] == message.message.player2 then
							message.message.mdp = priv_d[a].encrypt("RSA",mdp[a])
							renvoi_tampo[#renvoi_tampo+1] = message
						end
						if player[a] == message.message.player1 then
							message.message.mdp = priv_d[a].encrypt("RSA",mdp[a])
							message.id = pc_dest[a]
							message.gate = gate_dest[a]
							renvoi_tampo[#renvoi_tampo+1] = message
						end
					end
					file = fs.open("renvoi", "w")
					file.writeLine("renvoi_tampo = "..textutils.serialize(renvoi_tampo))
					file.close()
					x = 0
					repeat
						x = x + 1
						if demande_tampo[x+1] ~= nil then
							demande_tampo[x] = demande_tampo[x+1]
						end
					until x >= #demande_tampo
					demande_tampo[x] = nil
					file = fs.open("commande", "w")
					file.writeLine("demande_tampo = "..textutils.serialize(demande_tampo))
					file.close()
				end
			end
		end
		if message == "libre" and id == routeur then
			state = true
		end
		if id == banque_term then
			message = tonumber(message)
			if message == nil then
				message = 0
			end
			if line ~= nil then
			if #line > 0 then
				limit = #line - 15
				if message == 1 then
					if i < limit then
						i = i + 1
					end
				elseif message == -1 then
					if i > 0 then
						i = i - 1
					end
				end
			end
			end
		end
		if string.find(message, "drop-l-") and id == routeur then
			file = fs.open("update", "a")
			file.writeLine("le = "..os.day())
			nTime = os.time()
			file.writeLine("a = "..textutils.formatTime(nTime,false))
			file.writeLine("mess = "..message)
			file.close()
		end
		if string.find(message, "drop-i-") and id == routeur then
			file = fs.open("update", "a")
			file.writeLine("le = "..os.day())
			nTime = os.time()
			file.writeLine("a = "..textutils.formatTime(nTime,false))
			file.writeLine("mess = "..message)
			file.close()
		end
	end
end
function commande_unique(mess,client,vendeur)
	for a = 1, #attente_l do
		if mess.message.horaire == attente_l[a].message.horaire then
			if mess.message.ref == attente_l[a].message.ref then
				if mess.message.n == attente_l[a].message.n then
					if mess.message.player1 == attente_l[a].message.player1 then
						double = true
						break
					end
				end
			end
		end
	end
	if vendeur ~= nil and client ~= nil and double == false then
		if verif_compte[vendeur] == true and verif_compte[client] == true then
			mdp_carte2 = priv_d[client].decrypt("RSA",mess.message.mdp)
			if mdp_carte2 == mdp[client] then
				verif, err = http.get("http://"..httpdns.."/update/index.php?action=lecture&para2="..mess.message.type.."&para3="..player[vendeur])
				if verif then
					verif = verif.readAll()
					if verif ~= "db_error" then
						taille = string.len(verif)
						c = 0
						val = "<br />"
						t = 1
						val_posd = {}
						val_posf = {}
						repeat
							c = c + 1
							test = string.sub(verif,c,c+5)
							if string.find(test,val) then
								val_posd[t] = c - 1
								val_posf[t] = c + 6
								t = t + 1
							end
						until c >= taille
						vendeur_l = string.sub(verif,1,val_posd[1])
						ref = string.sub(verif,val_posf[1],val_posd[2])
						prix = string.sub(verif,val_posf[2],val_posd[3])
						type_item = string.sub(verif,val_posf[3],val_posd[4])
						dispo = string.sub(verif,val_posf[4],val_posd[5])
						name = string.sub(verif,val_posf[5],val_posd[6])
						date_inser = string.sub(verif,val_posf[6],val_posd[7])
						gate = string.sub(verif,val_posf[7],val_posd[8])
						pc = string.sub(verif,val_posf[8])
						f = fs.open("offre","w")
						f.writeLine(vendeur_l)
						f.writeLine(ref)
						f.writeLine(prix)
						f.writeLine(type_item)
						f.writeLine(dispo)
						f.writeLine(name)
						f.writeLine(date_inser)
						f.writeLine(gate)
						f.writeLine(pc)
						f.close()
						shell.run("offre")
						for a = 1, #ref do
							if ref[a] == mess.message.ref then
								if (type_item[a] == "fluide" and mess.message.n >= 1500 or mess.message.n >= 512000 ) or (type_item[a] ~= "fluide" and mess.message.n >= 1 or mess.message.n >= 1700) then
									attente_l[#attente_l+1] = message
									file = fs.open("attente", "w")
									file.writeLine("attente_l = "..textutils.serialize(attente_l))
									file.close()
									if type_item[a] == "fluide" then
										transfer = prix[a] * mess.message.n/1000
									else
										transfer = prix[a] * mess.message.n
									end
									transfer = prix[a] * mess.message.n
									if compte_coffre[client] >= transfer then
										compte_coffre[client] = compte_coffre[client] - transfer
										compte_coffre[vendeur] = compte_coffre[vendeur] + transfer
										id_carte = priv_d[vendeur].encrypt("RSA",mdp[vendeur])
										message = {id = pc[a],gate = gate[a], message = {player1 = mess.message.player1, player2 = player[vendeur],ref = mess.message.ref,n = mess.message.n, mdp = id_carte, type = message.message.type, horaire = os.clock(), routeur = false}}
										save()
										rapport_vendeur(nil, vendeur, client)
										rapport_client(nil, client, vendeur)
										time_out = 0
										renvoi_tampo[#renvoi_tampo+1] = message
										file = fs.open("renvoi", "w")
										file.writeLine("renvoi_tampo = "..textutils.serialize(renvoi_tampo))
										file.close()
									else
										a = client/5
										a = math.ceil(a)
										shell.run("/"..disk.getMountPath(drive_datac[a]).."/"..player[client].."-relever")
										shell.run("/"..disk.getMountPath(drive_datac[a]).."/"..player[client].."-histo-cert_abo")
										type_banque[#type_banque+1] = "font"
										time_date[#type_banque] = Hour.."h"..Minute.." "..day.."/"..mois
										total[#type_banque] = "error"
										destinataire[#type_banque] = player[vendeur]
										time[#type_banque] = Hour.."/"..day.."/"..mois
										info[#type_banque] = "na"
										save_histo(client, true)
									end
								end
								break
							end
						end
					end
				end
			end
		end
	end
end
function mem()
	while true do
		if state == true then
			if arret == true then
				if player_remove == true then
					arret_pc = 1
					repeat
						sleep(5)
					until arret_pc == 0
					os.reboot()
				end
				sleep(15)
				exit()
			end
			if update == true then
				if uplist ~= nil then
					uplist = nil
					rednet.send(routeur,"player")
				else
					update = 0
					for a = 1, #id_def do
						rednet.send(id_def[a],"maj")
						sleep(1)
						if message == "recu" then
							update = update + 1
						end
					end
					file = fs.open(historiacces, "a")
					file.writeLine(#id_def.." - "..update)
					file.close()
					cm = http.get(paste)
					file = fs.open("startup_maj","w")
					file.write(cm.readAll())
					file.close()
					cm.close()
					if fs.getSize("startup_maj") > 50000 then
						fs.delete("programme")
						fs.move("startup_maj","programme")
					end
					update = false
					arret_pc = true
					for a = 1, 8 do
						mon2.write("reboot")
						sleep(1)
					end
					os.reboot()
				end
			end
			if #demande_tampo > 0 then
				commande_tempo = demande_tampo[1]
				time_out = 0
				repeat
					rednet.send(routeur,commande_tempo)
					id, message = rednet.receive(1)
					time_out = time_out + 1
				until time_out > 10 or message == "recu"
				if message == "recu" then
					state = false
				end
			end
		end
		if #renvoi_tampo > 0 then
			repeat
				rednet.send(stargate,renvoi_tampo[1])
				id, message = rednet.receive(1)
				time_out = time_out + 1
			until time_out > 10 or message == "recu"
			if message == "recu" then
				x = 0
				repeat
					x = x + 1
					if renvoi_tampo[x+1] ~= nil then
						renvoi_tampo[x] = renvoi_tampo[x+1]
					end
				until x >= #renvoi_tampo
				renvoi_tampo[x] = nil
				file = fs.open("renvoi", "w")
				file.writeLine("renvoi_tampo = "..textutils.serialize(renvoi_tampo))
				file.close()
			end
		end
		if Minute_boutique < 1 then
			Minute_boutique = 15
			for a = 1, 10 do
				verif, err = http.get("http://"..httpdns.."/update/site.php?action=search&banque="..mdp[1])
				if verif then
					verif = verif.readAll()
					if verif ~= "db_error" and verif ~= "vide" then
						mess = {}
						taille = string.len(verif)
						c = 0
						val = "<br />"
						t = 1
						val_posd = {}
						val_posf = {}
						repeat
							c = c + 1
							test = string.sub(verif,c,c+5)
							if string.find(test,val) then
								val_posd[t] = c - 1
								val_posf[t] = c + 6
								t = t + 1
							end
						until c >= taille
						if #val_posf >=2 then
							vendeur = string.sub(verif,0,val_posd[1])
							client = string.sub(verif,val_posf[1],val_posd[2])
							for a = 1, #player do
								if player[a] == client then
									client = a
								end
								if player[a] == vendeur then
									vendeur = a
								end
							end
							if client ~= nil and vendeur ~= nil then
								mess.message.mdp = mdp[client]
								mess.message.mdp = pub_d[client].encrypt("RSA",mess.message.mdp)
								mess.message.ref = string.sub(verif,val_posf[2],val_posd[3])
								mess.message.n = string.sub(verif,val_posf[3],val_posd[4])
								mess.message.type = string.sub(verif,val_posf[4])
								mess.message.horaire = 1
								mess.message.player1 = player[client]
								commande_unique(mess,client,vendeur)
							end
						end
					else
						break
					end
				else
					break
				end
			end
		end
		sleep(10)
	end
end
parallel.waitForAll(bio, affich, secu, prod, carte, rednet_receive, getCompNames, restart_out, mouse, mem, controle_auto)