function bus_redstone(color,on_off)
	if color == "white" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.white))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.white))
		end
	elseif color == "orange" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.orange))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.orange))
		end
	elseif color == "magenta" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.magenta))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.magenta))
		end
	elseif color == "lightBlue" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.lightBlue))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.lightBlue))
		end
	elseif color == "yellow" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.yellow))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.yellow))
		end
	elseif color == "lime" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.lime))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.lime))
		end
	elseif color == "pink" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.pink))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.pink))
		end
	elseif color == "gray" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.gray))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.gray))
		end
	elseif color == "lightGray" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.lightGray))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.lightGray))
		end
	elseif color == "cyan" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.cyan))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.cyan))
		end
	elseif color == "purple" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.purple))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.purple))
		end
	elseif color == "blue" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.blue))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.blue))
		end
			
	elseif color == "brown" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.brown))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.brown))
		end
	elseif color == "green" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.green))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.green))
		end
	elseif color == "red" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.red))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.red))
		end
	elseif color == "black" then
		if on_off then
			redstone.setBundledOutput(redstone_direction,colors.combine(redstone.getBundledOutput(redstone_direction),colors.black))
		else
			redstone.setBundledOutput(redstone_direction,colors.subtract(redstone.getBundledOutput(redstone_direction), colors.black))
		end
	end
end