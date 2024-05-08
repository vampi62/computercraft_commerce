page10 = basalt.createFrame()
x, y = term.getSize()


page10:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page101:show()
    end)