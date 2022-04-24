--[[
0 = noir
1 = rouge
2 = vert
4 = bleu
new_paper = 1 --> import
new_paper = 2 --> rien
new_paper = 3 --> export
]] --
function printligne(textline,xpaper,ypaper,color,new_paper) -- x gauche droite
	local melist = compte_encre()
	if new_paper == 1 then
		for a = 1, #melist do
			if item[a].fingerprint.id == "minecraft:paper" then
				paper_interface.exportItem(item[a],interface_direction_paper,1)
				sleep(0.1)
				printer.newPage()
				break
			end
		end
	end
	for a = 1, #melist do
		if item[a].fingerprint.id == "minecraft:dye" and item[a].fingerprint.dmg == color then
			ink_interface.exportItem(item[a],interface_direction_ink,1)
			printer.setCursorPos(xpaper,ypaper)
			printer.write(textline)
			break
		end
	end
	if new_paper == 3 then
		printer.endPage()
		sleep(0.5)
	end
end