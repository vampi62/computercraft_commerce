page105 = basalt.createFrame()
x, y = term.getSize()

page105:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"info"/2), 2)
    :setText("info")
    :setSize(#"info",1)


page105:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page101:show()
    end)