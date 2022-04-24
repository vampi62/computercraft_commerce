--[[
	modifier le 14/03/2022
	par vampi62
	2.0
	programme terminal de la banque
]]--

os.pullEvent = os.pullEventRaw
local version = "2.0"
local labelcomp = "banque_term"
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
active_read = 0
confirm_recep = false
term0_mon1 = false
monitor = periperal.warp("top")
-- run prog --

function para_prog()
	parallel.waitForAny(readtemp, termtouch, redreceive)
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