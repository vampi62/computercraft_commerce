page104 = basalt.createFrame()
x, y = term.getSize()

page104:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page101:show()
    end)

page104:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"UPDATE"/2), 2)
    :setText("UPDATE")
    :setSize(#"UPDATE",1)

