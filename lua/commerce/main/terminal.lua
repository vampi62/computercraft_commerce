function termtouch()
	while run_prog do
		local event, button, x, y = os.pullEvent("mouse_click")
        active_read = 0
	end
end
function readbox()
    if active_read == 1 then
        text = read()
    else
        text = read("*")
    end
    active_read = 0
end
function eject()
	while active_read > 0 do
		sleep(0.8)
	end
end
function readtemp()
	while run_prog do
		if active_read then
			parallel.waitForAny(readbox, eject)
		end
		sleep(0.8)
	end
end


x = "dfrefg"
strings = {}
for i = 1, string.len(x) do
    strings[i] = string.sub(x,i, i)
	print(strings[i])
end


while true do
    local event, key, maintenue = os.pullEvent("key")
    write(keys.getName(key))
    print(" : "..tostring(maintenue))
end

while true do
    term.clear()
    
    local event, srollDirection, x, y = os.pullEvent("mouse_scroll")
    
    if scrollDirection == -1 then
       i = i + 1
    elseif scrollDirection == 1 then
       i = i - 1
    end
    
    term.setCursorPos(x, y)
    term.write(i)
 end