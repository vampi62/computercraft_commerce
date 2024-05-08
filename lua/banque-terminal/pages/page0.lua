page0 = basalt.createFrame()
x, y = term.getSize()

page0:addLabel()
    :setPosition(1 + (x/2) - math.floor(#config.terminalLabel/2), 2)
    :setText(config.terminalLabel)
    :setSize(#config.terminalLabel,1)

page0:addButton()
    :setPosition(1 + (x/2) - math.floor(#"inscription"/2), 8)
    :setText("connexion")
    :setSize(#"inscription",1)
    :onClick(function()
        page1:show()
    end)

page0:addButton()
    :setPosition(1 + (x/2) - math.floor(#"inscription"/2), 10)
    :setText("inscription")
    :setSize(#"inscription",1)
    :onClick(function()
        page2:show()
    end)


page0:addButton()
    :setPosition(1, 19)
    :setText("config")
    :setSize(8,1)
    :onClick(function()
        page100:show()
    end)

local timeLabel = page0:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page0TimeThread = page0:addThread()
page0TimeThread:start(function()
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
    end
end)