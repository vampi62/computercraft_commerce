--[[
	modifier le 21/12/2021
	par vampi62
	2.0
	programme de gestion des turtles
]]--

--[[ si vous voulez ajouter des fonctionnalité
	creer un ficher de config --> dans le dossier init
	creer une fonction (cycle d'action) --> dans le dossier function
	creer un grogram (assemblage de cycle d'action) --> dans le dossier program editer le fichier custom.lua
	creer un affichage terminal --> dans main editer le ficher custom_affichage.lua
]]--
os.pullEvent = os.pullEventRaw

--###### table d'echange ######--
version = "2.0"
config_id = "init/id_config"
coordonnees = "init/xyz"
turtle_config_pos = "init/turtle_config"
turtle_dir = ""
update_url = ""
turtle_type = ""
position_destination = {}
mine_sortie = false
pompe_sortie = false
run_prog = true
program_run = false
reponse_cycle = false
pos_x = 0
pos_y = 0
pos_z = 0
wifi_id = 0
pocket_id = 0
ip_turtle = 0
prod_en_cours = 0

if not fs.exists(config_id) then
	file = fs.open(config_id, "w")
	file.writeLine("pocket_id = ")
	file.writeLine("wifi_id = ")
	file.writeLine("password = ''")
	file.writeLine("turtle_type = --'pompe','custom','finder','dig'")
	file.writeLine("update_url = 'http://diodebanquecube.ddns.net/lua/'")
	file.close()
	shell.run("edit " ..config_id)
end
if not fs.exists(turtle_config_pos) then
	file = fs.open(turtle_config_pos, "w")
	file.writeLine("turtle_dir = 'center'")
	file.writeLine("mine_sortie = false")
	file.writeLine("pompe_sortie = false")
	file.writeLine("program_run = false")
	file.close()
	shell.run("edit " ..turtle_config_pos)
end
if not fs.exists(coordonnees) then
	file = fs.open(coordonnees, "w")
	file.writeLine("position_destination = {}")
	file.close()
	file = fs.open(coordonnees.."-init", "w")
	file.writeLine("pos_x = ")
	file.writeLine("pos_y = ")
	file.writeLine("pos_z = ")
	file.close()
	shell.run("edit "..coordonnees.."-init")
end
if turtle_type == "pompe" then
	if turtle_dir == 'right' then
		turtle.turnLeft()
		file = fs.open(turtle_config_pos, "w")
		file.writeLine("turtle_dir = 'center'")
		file.writeLine("mine_sortie = "..mine_sortie)
		file.writeLine("pompe_sortie = "..pompe_sortie)
		file.writeLine("program_run = "..program_run)
		file.close()
	end
end

local list = fs.list("init/")
for j = 1, #list do
	shell.run("init/"..list[j])
end
os.setComputerLabel(turtle_type.."-"..version)
ip_turtle = os.getComputerID()

--setup function

local list = fs.list("main/")
for j = 1, #list do
	shell.run("main/"..list[j])
end
local ist = fs.list("function/")
for j = 1, #list do
	shell.run("function/"..list[j])
end

function para_prog()
	parallel.waitForAny(secu, redsend, affichage, program)
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
		print("alors qu'une mise a jour à été installer récemment")
		print("verifier qu'il n'y ai pas de conflit avec votre custom")
		print("signaler le probleme si vous n'utiliser pas de custom")
		n = read()
	end
	sleep(0.2)
end