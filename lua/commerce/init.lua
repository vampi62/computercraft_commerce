--[[
	modifier le 14/03/2022
	par vampi62
	2.0
	programme commerce
]]--

os.pullEvent = os.pullEventRaw
local version = "2.0"
local labelcomp = "commerce"
os.setComputerLabel(labelcomp.."-"..version)

-- chargement des variables
local address_config = "init/.config"
local address_offre = "init/.offre"

local list = fs.list("init/")
for j = 1, #list do
	shell.run("init/"..list[j])
end


--setup function

local list = fs.list("main/")
for j = 1, #list do
	shell.run("main/"..list[j])
end
local list = fs.list("function/")
for j = 1, #list do
	shell.run("function/"..list[j])
end


--###### table d'echange ######--

if fs.exists(address_config) == false then
	files = fs.open(address_config, "w")
	files.write("mdp = ''--api key")
	files.write("url = ''")
	files.write("user = ''")
	files.write("recherche_statuts_paie = 'echange accepter paiement valider'")
	files.write("recherche_statuts_attente = 'validation vendeur en attente'")
	files.write("change_statuts_refus = 'echange refuser'")
	files.write("change_statuts_accepter = 'echange accepter paiement en attente'")
	files.write("change_statuts_pret = 'echange pret'")
	files.write("msg_change_statuts_ok = 'changement statuts ok'")
	files.write("msg_change_statuts_nok = 'erreur changement statuts'")
	files.write("message_code_ok = '0'")
	files.write("interval_minute_prod = 1-15")
	files.write("interval_minute_db = 1-5")
	files.close()
	shell.run(address_config)
	repeat
		shell.run("edit ".. address_config)
	until connectuser()
end
function save()
	files = fs.open(address_offre, "w")
	files.write("id = "..textutils.serialize(offre[1]))
	files.write("prix = "..textutils.serialize(offre[2]))
	files.write("stock_dispo = "..textutils.serialize(offre[3]))
	files.write("stock_resa = "..textutils.serialize(offre[4]))
	files.write("type = "..textutils.serialize(offre[5]))
	files.write("livraison = "..textutils.serialize(offre[6]))
	files.close()
	shell.run(address_offre)
	offre = {id,prix,stock_dispo,stock_resa,type,livraison}
end


affichage()
clavier()
souris()

connectuser()
list_offre()
connect_offre_gestion()



function init()
	local id = {1,3,7,8}
	local prix = {10,20,4,10}
	local stock_dispo = {1000,1112,1,122}
	local stock_resa = {10,20,4,10}
	local type = {"liquide","objet","liquide","objet"}
	local livraison = {"auto","auto","auto","auto"}
end

-- run prog --

if interval_minute_prod <= 0 then
	interval_minute_prod = 1
end
if interval_minute_db <= 0 then
	interval_minute_db = 1
end


function para_prog()
	parallel.waitForAny(ntp, affichage, clavier, prod, db_sync, traitement)
end

while run_prog do
	local etat, error_mes = pcall(para_prog)
	if not etat then
		local file = fs.open('log', 'a')
		file.writeLine(os.day()..':'..os.time()..' '..error_mes)
		file.close()
	end
	sleep(0.2)
end