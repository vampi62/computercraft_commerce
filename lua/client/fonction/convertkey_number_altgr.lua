function convertkey_number_altgr(numberkey)
	local stringkey = ""
	if global_clavier_maj["altgr"] then
		if numberkey == "zero" then
			stringkey = "@"
		end
	else
		local number_maj_tab = {">","0","1","2","3","4","5","6","7","8","9","-","+",".","?","/","%","0","1","2","3","4","5","6","7","8","9","."}
		local number_min_tab = {"<","&","","","","","","-","","_","","","",";",",",":","","0","1","2","3","4","5","6","7","8","9","."}
		local stringtab = {"nil","zero","one","two","three","four","five","six","seven","eight","nine","leftBracket","equals","period","comma","slash","grave","numPad0","numPad1","numPad2","numPad3","numPad4","numPad5","numPad6","numPad7","numPad8","numPad9","numPadAdd"}
		for j=1, #stringtab do
			if numberkey == stringtab[j] then
				if global_clavier_maj["lock"] or global_clavier_maj["shift"] then
					stringkey = number_maj_tab[j]
				else
					stringkey = number_min_tab[j]
				end
				break
			end
		end
	end
	return stringkey
end