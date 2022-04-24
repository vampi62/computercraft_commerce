function move()
	sleep(0.3)
	local file = fs.open(coordonnees, "w")

	if pos_y < position_destination[1]["y"] then
		file.writeLine("pos_x = "..pos_x)
		file.writeLine("pos_y = "..pos_y+1)
		file.writeLine("pos_z = "..pos_z)
		file.close()
		peripheral.call("front","move",1,false,false)
	elseif pos_y > position_destination[1]["y"] then
		file.writeLine("pos_x = "..pos_x)
		file.writeLine("pos_y = "..pos_y-1)
		file.writeLine("pos_z = "..pos_z)
		file.close()
		peripheral.call("front","move",0,false,false)
	end
	if pos_z < position_destination[1]["z"] then
		file.writeLine("pos_x = "..pos_x)
		file.writeLine("pos_y = "..pos_y)
		file.writeLine("pos_z = "..pos_z+1)
		file.close()
		peripheral.call("front","move",3,false,false)
	elseif pos_z > position_destination[1]["z"] then
		file.writeLine("pos_x = "..pos_x)
		file.writeLine("pos_y = "..pos_y)
		file.writeLine("pos_z = "..pos_z-1)
		file.close()
		peripheral.call("front","move",2,false,false)
	end
	if pos_x < position_destination[1]["x"] then
		file.writeLine("pos_x = "..pos_x+1)
		file.writeLine("pos_y = "..pos_y)
		file.writeLine("pos_z = "..pos_z)
		file.close()
		peripheral.call("front","move",5,false,false)
	elseif pos_x > position_destination[1]["x"] then
		file.writeLine("pos_x = "..pos_x-1)
		file.writeLine("pos_y = "..pos_y)
		file.writeLine("pos_z = "..pos_z)
		file.close()
		peripheral.call("front","move",4,false,false)
	end
	file.writeLine("pos_x = "..pos_x)
	file.writeLine("pos_y = "..pos_y)
	file.writeLine("pos_z = "..pos_z)
	file.close()
end