function eject_coffre_box(ae_import_box,interface,interface_dir)
    local melist = ae_import_box.getAvailableItems()
    box_drop_item(interface,interface_dir,melist[1].fingerprint,1)
end