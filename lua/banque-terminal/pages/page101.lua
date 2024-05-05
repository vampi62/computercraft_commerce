page101 = basalt.createFrame()
x, y = term.getSize()

page101:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page0:show()
    end)

page101:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"configurations"/2), 2)
    :setText("configurations")
    :setSize(#"configurations",1)

page101:addButton()
    :setPosition(1 + (x/2) - math.floor(#"changer mdp"/2), 4)
    :setText("changer mdp")
    :setSize(#"changer mdp",1)
    :onClick(function()
        page102:show()
    end)

page101:addButton()
    :setPosition(1 + (x/2) - math.floor(#"acces API"/2), 6)
    :setText("acces API")
    :setSize(#"acces API",1)
    :onClick(function()
        page103:show()
    end)

page101:addButton()
    :setPosition(1 + (x/2) - math.floor(#"mise a jour"/2), 8)
    :setText("mise a jour")
    :setSize(#"mise a jour",1)
    :onClick(function()
        page104:show()
    end)

page101:addButton()
    :setPosition(1 + (x/2) - math.floor(#"info terminal"/2), 10)
    :setText("info terminal")
    :setSize(#"info terminal",1)
    :onClick(function()
        page105:show()
    end)

page101:addButton()
    :setPosition(1 + (x/2) - math.floor(#"about"/2), 12)
    :setText("about")
    :setSize(#"about",1)
    :onClick(function()
        page106:show()
    end)

local timeLabel = page101:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page101TimeThread = page101:addThread()
page101TimeThread:start(function()
    page101aletTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page101aletTempo > 0 then
            page101aletTempo = page101aletTempo - 1
            if page101aletTempo == 0 then
                page101alert:remove()
            end
        end
    end
end)