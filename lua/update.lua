--[[
programme de telechargement des fichiers depuis un serveur web apache
par vampi62
derniere modification : 24/08/2022
https://github.com/vampi62/computercraft_commerce
]]--


min_y_page = 4
max_y_page = 19

config_http = "config/.config"
if not fs.isDir("config") then
	fs.makeDir("config")
end
local list = fs.list("config/")
for j = 1, #list do
	shell.run("config/"..list[j])
end
if global_url == nil then
	files = fs.open(config_http, "w")
	files.writeLine("--[[ completer l'url avec vos informations ]]--")
	files.writeLine("global_url = '__ip__or__domain__'")
	files.writeLine("global_port = '80'")
	files.writeLine("global_api_uri = 'api_computercraft'")
	files.writeLine("global_lua_uri = 'lua'")
	files.writeLine("--[[ retirer le commentaire sur le type de poste a installer ]]--")
	files.writeLine("-- global_poste = 'client'")
	files.writeLine("-- global_poste = 'commerce'")
	files.writeLine("-- global_poste = 'banque_terminal'")
	files.writeLine("-- global_poste = 'banque_routeur'")
	files.writeLine("-- global_poste = 'banque_admin'")
	files.close()
	shell.run("edit " .. config_http)
	shell.run(config_http)
end
update_repertoire = {}
update_file = {}
update_message = {}
update_console_etape_msg = ""
value_scroll = min_y_page - 1
key = ""
limite_value_scroll_haut = false
limite_value_scroll_bas = false

update_val1 = "alt=\"[DIR]\">"
update_val2 = "alt=\"[   ]\">"
update_valend = "\">"

function update_maj()
	table.insert(update_repertoire,{url = "http://" .. global_url .. ":" .. global_port .. "/" .. global_lua_uri .. "/" .. global_poste .. "/", dir = ""})
	local j = 1
	while j <= #update_repertoire do
		update_console("etape","recherche repertoire de mise a jour")
		update_console("message",update_repertoire[j]["url"])
		return_statut = update_debut_balise(update_repertoire[j]["url"],update_repertoire[j]["dir"])
		if not return_statut then
			break
		end
		j = j + 1
		sleep(0.1)
	end
	if return_statut then
		local j = 1
		update_console("etape","recherche repertoire de mise a jour terminer")
		update_console("message","-------------------")
		update_console("message",#update_file .. " fichiers a telecharger")
		sleep(3)
		while j <= #update_file do
			update_console("etape","telechargement des nouveaux fichiers " .. j .."/"..#update_file)
			update_console("message","[+] /"..update_file[j]["dir"])
			return_statut = update_download_fichier("/" .. update_file[j]["dir"],update_file[j]["url"])
			if not return_statut then
				break
			end
			j = j + 1
			sleep(0.2)
		end
	end
	if return_statut then
		update_console("etape","mise a jour terminer")
		update_console("message","-------------------")
		update_console("message",#update_file .. " fichiers telecharger avec succes")
	end
	update_console("message","-------------------")
	update_console("message","appuie sur une touche pour quitter le mode mise a jour et redemarrer le poste")
	sleep(1)
end
function update_affichage_console(suivre_bas)
	term.setCursorPos(1,1)
	term.write("mise a jour : " ..global_poste.." - version : 1.1")
	term.setCursorPos(1,2)
	term.write(update_console_etape_msg)
	local offset_text = 0
	limite_value_scroll_haut = false
	limite_value_scroll_bas = false
	for j=1, #update_message do
		local y = value_scroll + offset_text + j
		if y <= max_y_page and y >= min_y_page then
			if j == 1 then
				limite_value_scroll_haut = true
			end
			if j == #update_message and y <= max_y_page then
				limite_value_scroll_bas = true
			end
			local iy = 0
			for i=0, string.len(update_message[j]), 52 do
				offset_text = offset_text + 1
				if y + iy <= max_y_page and y >= min_y_page then
					term.setCursorPos(1,y + iy)
					term.write(string.sub(update_message[j],i,i+51))
				elseif y + iy > max_y_page then
					limite_value_scroll_bas = false
					break
				end
				iy = iy + 1
			end
			offset_text = offset_text - 1
		elseif y > max_y_page then
			break
		end
	end
	if suivre_bas and not limite_value_scroll_bas then -- auto-scroll si on suis l'input
		value_scroll = value_scroll - 1
		term.clear()
		update_affichage_console(true)
	end
end
function update_fin_balise(update_content,update_taille,update_c)
	for update_d = update_c + 29, update_taille do
		local update_test = string.sub(update_content,update_d,update_d+1)
		if update_test == update_valend then
			update_return_d = update_d
			break
		end
	end
	return update_return_d
end
function update_debut_balise(url,dir)
	local update_content = http.get(url)
	if update_content == nil then
		update_console("etape","erreur mise a jour")
		update_console("message","-------------------")
		update_console("message","impossible de telecharger la liste des fichiers du repertoire : " .. url)
		update_console("message","verifier les droits acces en lecture du repertoire")
		return false
	else
		local update_content = update_content.readAll()
		local update_taille = string.len(update_content)
		for update_c = 500, update_taille do
			update_test = string.sub(update_content,update_c,update_c+11)
			if update_test == update_val1 then
				local update_d = update_fin_balise(update_content,update_taille,update_c)
				table.insert(update_repertoire,{url = url .. string.sub(update_content,update_c+30,update_d-1), dir = dir .. string.sub(update_content,update_c+30,update_d-1)})
			end
			if update_test == update_val2 then
				local update_d = update_fin_balise(update_content,update_taille,update_c)
				--table.insert(update_file,{url = url .. string.sub(update_content,update_c+30,update_d-1),dir = dir .. string.gsub(string.sub(update_content,update_c+30,update_d-1), ".lua", "")})
				table.insert(update_file,{url = url .. string.sub(update_content,update_c+30,update_d-1),dir = dir .. string.sub(update_content,update_c+30,update_d-1)})
			end
		end
		return true
	end
end
function update_download_fichier(fichier,url)
	if fs.exists(fichier) then
		fs.delete(fichier)
	end
	update_content = http.get(url)
	if update_content == nil then
		update_console("etape","erreur mise a jour")
		update_console("message","-------------------")
		update_console("message","impossible de telecharger le fichier : " .. url)
		update_console("message","verifier les droits acces en lecture du fichier")
		return false
	else
		local update_document = fs.open(fichier,"w")
		update_document.write(update_content.readAll())
		update_document.close()
		return true
	end
end
function update_console(textype,message)
	if textype == "etape" then
		update_console_etape_msg = message
	elseif textype == "message" then
		table.insert(update_message,message)
	end
end
function scroll()
	while true do
		local event, value_scrollDirection, x, y = os.pullEvent("mouse_value_scroll")
		if value_scrollDirection == -1 then
			if not limite_value_scroll_haut then
				value_scroll = value_scroll + 1
				term.clear()
				update_affichage_console(false)
			end
		elseif value_scrollDirection == 1 then
			if not limite_value_scroll_bas then
				value_scroll = value_scroll - 1
				term.clear()
				update_affichage_console(false)
			end
		end
	end
end
function back()
	local ancien_value_scroll = -1 -- -1 pour generer l'affichage du demarrage
	local ancien_update_message = 0
	while true do
		if #update_message ~= ancien_update_message then
			ancien_update_message = #update_message
			term.clear()
			update_affichage_console(limite_value_scroll_bas)
		end
		sleep(0.5)
	end
end
function clavier()
	local event, key, maint = os.pullEvent("key")
end

parallel.waitForAny(scroll, update_maj, back)
parallel.waitForAny(scroll, clavier)
if fs.exists("config/update") then
	fs.delete("config/update")
end
os.reboot()