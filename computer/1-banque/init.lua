--[[
	modifier le 14/03/2022
	par vampi62
	2.0
	programme banque
]]--

os.pullEvent = os.pullEventRaw
local version = "2.0"
local labelcomp = "banque"
os.setComputerLabel(labelcomp.."-"..version)


-- chargement des variables

local list = fs.list("init/")
for j = 1, #list do
	shell.run("init/"..list[j])
end


--setup function

local list = fs.list("main/")
for j = 1, #list do
	shell.run("main/"..list[j])
end
local ist = fs.list("function/")
for j = 1, #list do
	shell.run("function/"..list[j])
end


--###### table d'echange ######--

for j = 1, nbr_box_dispo do
	if not pc_perif_box[j] == '' then
		pc_perif_box[j] = peripheral.wrap(pc_perif_box[j])
		monitor_box[j] = peripheral.wrap(monitor_box[j])
		monitor_box[j].clear()
		monitor_box[j].setTextScale(0.5)
		drive_ssd_box[j] = peripheral.wrap(drive_ssd_box[j])
		me_box[j] = peripheral.wrap(me_box[j])
		me_import_box[j] = peripheral.wrap(me_import_box[j])
		interface_import_box[j] = peripheral.wrap(interface_import_box[j])
		interface_export_box[j] = peripheral.wrap(interface_export_box[j])
		xbox[j] = -1
		ybox[j] = -1
		textbox[j] = ""
		pagebox[j] = 0
		session[j] = {}
		transaction_box[j] = {}
	end
end
papier = 0
encre = 0
Minute = 0
Hour = 0
day = 0
mois = 0


-- run prog --

function para_prog()
	parallel.waitForAny(receive, monitordetect, ntp, program)
end

while run_prog do
	local etat, error_mes = pcall(para_prog)
	if not etat then
		local file = fs.open('log', 'a')
		file.writeLine(os.day()..':'..os.time()..' '..error_mes)
		file.close()
	end
	if mise_a_jour and not etat then
		run_prog = false
		print("le programme à céssé de fonctionner")
		print("alors qu'une mise à jour à été installer récemment")
		print("verifier qu'il n'y ai pas de conflit avec votre custom")
		print("signaler le probleme si vous n'utiliser pas de custom")
		print("si vous shouhaitait restaurer un backup,")
		print("remplacer tous les fichers par ceux du repertoire :")
		print("backup_update")
		n = read()
	end
	sleep(0.2)
end