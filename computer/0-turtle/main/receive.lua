function sender(local envoie_mess)
	rednet.send(wifi_id,envoie_mess)
	rednet.send(pocket_id,envoie_mess)
end


function redsend()
	local message = ""
	local id = 0
	local table_message = {}
	local temp_position_destination = {}
	local coo = {}
	local temppassword = ""
	while true do
		local id , message = rednet.receive()
		if id == pocket or id == wifi_id then
			if message == "init_syncro" then
				local id , table_message = rednet.receive(1)
				if type(table_message) == "table" then
					local temp_position_destination = position_destination
					for n = 1, #table_message do
						for j = 1, #position_destination do
							if position_destination[j] == table_message[n] then
								table_message[n] = nil
								break
							end
						end
						if table_message[n] ~= nil then
							temp_position_destination[#temp_position_destination + 1] = message[n]
						end
					end
					files = fs.open(coordonnees, "w")
					files.write("position_destination = "..textutils.serialize(temp_position_destination))
					files.close()
					shell.run(coordonnees)
					sender("ras_list")
				end
			end
			if message == "coo" then
				coo = {x = pos_x,y = pos_y,z= pos_z}
				sleep(1)
				sender(coo)
			end
			if message == "arret" then
				temppassword = read()
				if password == temppassword then
					run_prog = false
					sleep(1)
					sender("arret")
					exit()
				end
			end
			if message == "ping" then
				sleep(1)
				sender("ping")
			end
			if message == "start" then
				program_run = false
				local file = fs.open(turtle_config_pos, "w")
				file.writeLine("turtle_dir = "..turtle_dir)
				file.writeLine("mine_sortie = "..mine_sortie)
				file.writeLine("pompe_sortie = "..pompe_sortie)
				file.writeLine("program_run = "..program_run)
				file.close()
				sleep(1)
				sender("start")
			end
			if message == "stop" then
				program_run = true
				local file = fs.open(turtle_config_pos, "w")
				file.writeLine("turtle_dir = "..turtle_dir)
				file.writeLine("mine_sortie = "..mine_sortie)
				file.writeLine("pompe_sortie = "..pompe_sortie)
				file.writeLine("program_run = "..program_run)
				file.close()
				sleep(1)
				sender("stop")
			end
			if message == "maj" then
				local httpmaj = http.get(paste)
				local file = fs.open("maj_program","w")
				file.write(httpmaj.readAll())
				file.close()
				sleep(1)
				sender("maj")
				os.reboot()
			end
		end
	end
end