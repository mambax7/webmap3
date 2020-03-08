<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://earth.google.com/kml/2.1">
    <{if $document.tag_use }>
    <Document>
        <{if $document.name != '' }>
            <name><{$document.name}></name>
        <{/if}>
        <{if $document.description != '' }>
            <description><{$document.description}></description>
        <{/if}>
        <{if $document.open_use && ($document.open != '') }>
            <open><{$document.open}></open>
        <{/if}>
        <{/if}>
        <{if $folder.tag_use }>
        <Folder>
            <{if $folder.name != '' }>
                <name><{$folder.name}></name>
            <{/if}>
            <{if $folder.description != '' }>
                <description><{$folder.description}></description>
            <{/if}>
            <{if $folder.open_use && ($folder.open != '') }>
                <open><{$folder.open}></open>
            <{/if}>
            <{/if}>
            <{* === placemark loop === *}>
            <{foreach item=placemark from=$placemarks}>
                <Placemark>
                    <{if $placemark.name != '' }>
                        <name><{$placemark.name}></name>
                    <{/if}>
                    <{if $placemark.description != '' }>
                        <description><![CDATA[ <{$placemark.description}> ]]></description>
                    <{/if}>
                    <Point>
                        <coordinates><{$placemark.longitude}>,<{$placemark.latitude}></coordinates>
                    </Point>
                </Placemark>
            <{/foreach}>
            <{* === placemark loop end === *}>
            <{if $folder.tag_use }>
        </Folder>
        <{/if}>
        <{if $document.tag_use }>
    </Document>
    <{/if}>
</kml>
<{* http://earth.google.com/kml/ *}>
<{* $Id: main_kml.html,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $ *}>
