import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import LinkTool from '@editorjs/link';
import RawTool from '@editorjs/raw';
import SimpleImage from "@editorjs/simple-image";
import ImageTool from '@editorjs/image';
import Checklist from '@editorjs/checklist'
import List from "@editorjs/list";
import Embed from '@editorjs/embed';
import Quote from '@editorjs/quote';


let editor = new EditorJS({
    
    /**
     * Id of Element that should contain Editor instance
     */
    
    holder: 'editorjs',
    tools: { 
        header: {
            class: Header,
            config: {
              placeholder: 'Enter a header',
              levels: [3, 4],
              defaultLevel: 3
            }
        },

        // linkTool: {
        //     class: LinkTool,
        //     config: {
        //       endpoint: 'http://localhost:8008/fetchUrl', // Your backend endpoint for url data fetching,
        //     }
        // },

        image: {
            class: ImageTool,
            config: {
              
              endpoints: {
                byFile: '/upload-image',
              },
              additionalRequestHeaders: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              }
            }
        },

        // checklist: {
        //     class: Checklist,
        //     inlineToolbar: true,
        // },

        // list: {
        //     class: List,
        //     inlineToolbar: true,
        //     config: {
        //       defaultStyle: 'unordered'
        //     }
        // },

        // embed: {
        //     class: Embed,
        //     config: {
        //       services: {
        //         youtube: true,
        //         coub: true
        //       }
        //     }
        // },

        quote: {
            class: Quote,
            inlineToolbar: true,
            config: {
              quotePlaceholder: 'Enter a quote',
              captionPlaceholder: 'Quote\'s author',
            },
        },
    },

    onChange: async () =>{

    }
})


document.addEventListener('DOMContentLoaded', function () {
  const editorData = document.getElementById('editorData');
  if (editorData) {
    if(editorData.value != ""){
      editor.isReady.then(() => {
        return editor.render(JSON.parse(editorData.value));
      });
    }
  }
});




document.querySelector('#redact-form').addEventListener('submit', function (e) {
  e.preventDefault();

  editor.save().then((outputData) => {
      document.querySelector('#editorData').value = JSON.stringify(outputData);
      this.submit();
  }).catch((error) => {
      console.error('Saving failed: ', error);
  });
});