function scroll()
	while true do
		local event, scrollDirection, x, y = os.pullEvent("mouse_scroll")
		if scrollDirection == -1 then
			if not global_limite_scroll_haut then
				global_scroll = global_scroll + 1
			end
		elseif scrollDirection == 1 then
			if not global_limite_scroll_bas then
				global_scroll = global_scroll - 1
			end
		end
		sleep(0.05)
	end
end