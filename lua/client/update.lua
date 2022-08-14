local update_repertoire = {}
local update_file = {}
local update_message = {}
local update_val1 = "alt=\"[DIR]\">"
local update_val2 = "alt=\"[   ]\">"
local update_valend = "\">"
local update_console_etape_msg = ""

function update_maj(dns,poste)
	global_update = true
	local oldPullEvent = os.pullEvent
	os.pullEvent = os.pullEventRaw
	table.insert(update_repertoire,{url = dns .. poste .. "/", dir = ""})
	local j = 1
	while j <= #update_repertoire do
		update_console("etape","recherche repertoire de mise a jour")
		update_console("message",update_repertoire[j]["url"])
		update_debut_balise(update_repertoire[j]["url"],update_repertoire[j]["dir"])
		j = j + 1
		sleep(1)
	end
	local j = 1
	update_console("etape","recherche repertoire de mise a jour terminer")
	update_console("message","-------------------")
	update_console("message",#update_file .. " fichiers a telecharger")
	sleep(3)
	while j <= #update_file do
		update_console("etape","telechargement des nouveaux fichiers " .. j .."/"..#update_file)
		update_console("message",update_file[j]["dir"])
		update_download_fichier("/" .. update_file[j]["dir"],update_file[j]["url"])
		j = j + 1
		sleep(1)
	end
	update_console("etape","mise a jour terminer")
	update_console("message","-------------------")
	update_console("message",#update_file .. " fichiers telecharger avec succes")
	global_update = false
	os.pullEvent = oldPullEvent
end
function update_affichage_console()
	term.setCursorPos(1,12)
	term.write(update_console_etape_msg)
	update_taille_ligne = 1
	for j = 1, 4 do
		local update_ligne_console = j + update_taille_ligne - 1
		if update_ligne_console < 5 then
			term.setCursorPos(1,12+update_ligne_console)
			local update_limit_scroll = #update_message-4
			if global_scroll > update_limit_scroll and update_limit_scroll > 0 then
				global_scroll = update_limit_scroll
			end
			local update_pointeur_console = #update_message - 4 + j - global_scroll
			if update_message[update_pointeur_console] ~= nil then
				update_taille_ligne = print(update_message[update_pointeur_console])
			end
		end
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
end
function update_download_fichier(fichier,url)
	if fs.exists(fichier) then
		fs.delete(fichier)
	end
	local update_content = http.get(url)
	local update_document = fs.open(fichier,"w")
	update_document.write(update_content.readAll())
	update_document.close()
end
function update_console(textype,message)
	if textype == "etape" then
		update_console_etape_msg = message
	elseif textype == "message" then
		table.insert(update_message,message)
	end
end