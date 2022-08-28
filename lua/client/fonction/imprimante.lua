function imprimante(printer,action,text,x,y,color)
	if action == "page" then
		if printer.getPaperLevel() > 0 then
			printer.newPage()
		else
			return false
		end
	elseif action == "texte" then
		if printer.getInkLevel() > 0 then
			imprimante_print_line(printer,text,x,y)
		else
			if color then
				color["interface"].exportItem(color["fingerprint"],color["direction"],1)
				sleep(0.5)
				if printer.getInkLevel() > 0 then
					imprimante_print_line(printer,text,x,y)
				else
					return false
				end
			else
				return false
			end
		end
	elseif action == "titre" then
		printer.setPageTitle(text)
	elseif action == "sortie" then
		printer.endPage()
	else
		return false
	end
	return true
end
local function imprimante_print_line(printer,text,x,y)
	printer.setCursorPos(x,y)
	printer.write(text)
end