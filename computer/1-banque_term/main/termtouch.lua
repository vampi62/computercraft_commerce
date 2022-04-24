function termtouch()
	while run_prog do
		local event, button, x, y = os.pullEvent("mouse_click")
		repeat
            rednet.send(banque,{x,y})
            sleep(0.5)
        until confirm_recep
        confirm_recep = false
	end
end