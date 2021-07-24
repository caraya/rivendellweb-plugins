// Let's see if it works
import { MyColors } from '../../lib/colors';
// WordPress Imports
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import {
    PanelBody,
    PanelRow,
    ColorPalette,
} from '@wordpress/components';
import {
    RichText,
    InnerBlocks,
    AlignmentToolbar,
    BlockControls,
    InspectorControls,
} from '@wordpress/block-editor';

registerBlockType( 'rivendellweb-blocks/example-07', {
    title: __( 'Example 07', 'rivendellweb-blocks'),
    description: __( 'Working on figuring out sidebars and toolbars', 'rivendellweb-blocks' ),
    icon: 'smiley',
    category: 'rivendellweb-blocks',
    attributes: {
        content: {
            type: 'array',
            source: 'children',
            selector: 'p',
        },
        alignment: {
            type: 'string',
            default: 'none',
        },
        textColor: {
          type: 'string',
          default: '',
        }
    },
    example: {
        attributes: {
            content: 'Hello World',
            alignment: 'right',
        },
    },
    edit: ( props ) => {
        const {
            attributes: {
                content,
                alignment,
            },
            className,
        } = props;

        const onChangeContent = ( newContent ) => {
            props.setAttributes( { content: newContent } );
        };

        const onChangeAlignment = ( newAlignment ) => {
            props.setAttributes( { alignment: newAlignment === undefined ? 'none' : newAlignment } );
        };

        return (
            <div>
                {
                    <BlockControls>
                        <AlignmentToolbar
                            value={ alignment }
                            onChange={ onChangeAlignment }
                        />
                    </BlockControls>
                }

                {
                  <InspectorControls>
                    <PanelBody
                      title={ __( 'Text Colors', 'rivendellweb-blocks' ) } >
                      <PanelRow>
                        <ColorPalette
                          colors={ MyColors }/>
                      </PanelRow>
                    </PanelBody>
                    <PanelBody
                      title={ __( 'Background Colors', 'rivendellweb-blocks' ) } >
                      <PanelRow>
                        <ColorPalette
                          colors={ MyColors } />
                      </PanelRow>
                    </PanelBody>

                  </InspectorControls>

                }
                <RichText
                    className={ className }
                    style={ { textAlign: alignment } }
                    tagName="p"
                    onChange={ onChangeContent }
                    value={ content }
                />
                <InnerBlocks/>
            </div>
        );
    },
    save: ( props ) => {
        return (
            <RichText.Content
                className={ `gutenberg-examples-align-${ props.attributes.alignment }` }
                tagName="p"
                value={ props.attributes.content }
            />
        );
    },
} );
