-- mise a jour des turtles

if os.getComputerLabel() == "init" or os.getComputerLabel() == "" then
	fs.makeDir("main")
	fs.makeDir("init")
	fs.makeDir("function")
	fs.makeDir("program")
	local all_file = {}
	all_file[1] = {labelcomp.."/main/affichage.lua","main/affichage.lua"}
	all_file[2] = {labelcomp.."/main/anti_disk.lua","main/anti_disk.lua"}
	all_file[3] = {labelcomp.."/main/custom_affichage.lua","main/custom_affichage.lua"}
	all_file[4] = {labelcomp.."/main/program.lua","main/program.lua"}
	all_file[5] = {labelcomp.."/main/receive.lua","main/receive.lua"}
	all_file[6] = {labelcomp.."/program/custom.lua","program/custom.lua"}
	all_file[7] = {labelcomp.."/program/dig.lua","program/dig.lua"}
	all_file[8] = {labelcomp.."/program/finder.lua","program/finder.lua"}
	all_file[9] = {labelcomp.."/program/pompe.lua","program/pompe.lua"}
	all_file[10] = {labelcomp.."/function/pompe.lua","function/pompe.lua"}
	all_file[11] = {labelcomp.."/function/dig.lua","function/dig.lua"}
	all_file[12] = {labelcomp.."/function/move.lua","function/move.lua"}
	all_file[13] = {labelcomp.."/function/minage.lua","function/minage.lua"}
	all_file[14] = {"generic_function/update.lua","function/update.lua"}
	all_file[15] = {"startup.lua","startup"}

	
	for j = 1, #all_file do
		local httpmaj = http.get(update_url.."program/"..all_file[j][1])
		if httpmaj.getResponseCode() == 200 then
			local file = fs.open(all_file[j][2],"w")
			file.write(httpmaj.readAll())
			file.close()
		else
			j = j - 1
			print("erreur de telechargement ficher :"..all_file[j][2])
		end
	end
else
	print("chargement de la configuration")
	rednet.send(pcmaitre,"chargement de la configuration")
	local list = fs.list("init/")
	for j = 1, #list do
		shell.run("init/"..list[j])
	end
	sleep(2)
	--[[
	if version <= 2.0 then
		print("ajout de variables dans les fichiers de config existant")
		local file = fs.open(config_id, "w")
		file.writeLine("null = ")
		file.close()
		local file = fs.open(turtle_config_pos, "w")
		file.writeLine("null = ")
		file.writeLine("-- note la variable null n'est plus utilise")
		file.close()
		sleep(2)
		shell.run("edit " ..config_id)
		shell.run("edit " ..turtle_config_pos)
	end
	]]--
	print("mise a jour des fichiers programme")
	--[[
	if version <= 2.0 then
		local all_file = {}
		all_file[1] = "main/affichage.lua"
		all_file[2] = "main/anti_disk.lua"
		all_file[3] = "main/custom_affichage.lua"
		
		for j = 1, #all_file do
			local httpmaj = http.get(paste..all_file[j])
			if httpmaj.getResponseCode() == 200 then
				local file = fs.open(all_file[j],"w")
				file.write(httpmaj.readAll())
				file.close()
			end
		end
		
		fs.delete("notused.lua")
	end
	]]--
	sleep(2)
	print("mise a jour terminer le poste va redemarrer dans quelques secondes")
	fs.move("maj_program","maj_program_ok")
	sleep(2)
end
os.reboot()