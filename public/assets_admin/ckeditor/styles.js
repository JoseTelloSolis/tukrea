/**
 * Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// This file contains style definitions that can be used by CKEditor plugins.
//
// The most common use for it is the "stylescombo" plugin, which shows a combo
// in the editor toolbar, containing all styles. Other plugins instead, like
// the div plugin, use a subset of the styles on their feature.
//
// If you don't have plugins that depend on this file, you can simply ignore it.
// Otherwise it is strongly recommended to customize this file to match your
// website requirements and design properly.

CKEDITOR.stylesSet.add( 'default', [
	// Block Styles
    { name: 'Blue Title',       element: 'h3',      styles: { 'color': 'Blue' } },
    { name: 'Red Title',        element: 'h3',      styles: { 'color': 'Red' } },

    // Inline Styles
    { name: 'Marker: Yellow',   element: 'span',    styles: { 'background-color': 'Yellow' } },
    { name: 'Marker: Green',    element: 'span',    styles: { 'background-color': 'Lime' } },

    // Object Styles
    {
        name: 'Image on Left',
        element: 'img',
        attributes: {
            style: 'padding: 5px; margin-right: 5px',
            border: '2',
            align: 'left'
        }
    }
] );

CKEDITOR.stylesSet.add( 'mystyles', [
	// Block Styles
    { name: 'Blue Title',       element: 'h3',      styles: { 'color': 'Blue' } },
    { name: 'Red Title',        element: 'h3',      styles: { 'color': 'Red' } },

    // Inline Styles
    { name: 'Marker: Yellow',   element: 'span',    styles: { 'background-color': 'Yellow' } },
    { name: 'Marker: Green',    element: 'span',    styles: { 'background-color': 'Lime' } },

    // Object Styles
    {
        name: 'Image on Left',
        element: 'img',
        attributes: {
            style: 'padding: 5px; margin-right: 5px',
            border: '2',
            align: 'left'
        }
    }
] );

