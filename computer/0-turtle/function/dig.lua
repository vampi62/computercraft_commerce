function dig()
	prod_en_cours = 0
	repeat
		if turtle.detect() then
			turtle.dig()
			prod_en_cours = prod_en_cours + 1
		end
		sleep(0.75)
	until prod_en_cours >= 64
end