<div class="toolbar">
                <button onclick="execCommand('bold')" title="Bold"><b>B</b></button>
                <button onclick="execCommand('italic')" title="Italicize"><i>I</i></button>
                <button onclick="execCommand('underline')" title="Underline"><u>U</u></button>
                <button onclick="execCommand('strikeThrough')" title="Strike through"><s>S</s></button>

                <select id="block-format" onchange="setParagraphStyle()">
                    <option value="p">Paragraph</option>
                    <option value="h1">Heading 1</option>
                    <option value="h2">Heading 2</option>
                    <option value="h3">Heading 3</option>
                </select>

                <button onclick="execCommand('justifyLeft')" title="Align Left"><i class="fas fa-align-left"></i></button>
                <button onclick="execCommand('justifyCenter')" title="Align Center"><i class="fas fa-align-center"></i></button>
                <button onclick="execCommand('justifyRight')" title="Align Right"><i class="fas fa-align-right"></i></button>
                <button onclick="execCommand('justifyFull')" title="Justify Content"><i class="fas fa-align-justify"></i></button>

                <button onclick="execCommand('insertOrderedList')" title="Ordered List"><i class="fas fa-list-ol"></i></button>
                <button onclick="execCommand('insertUnorderedList')" title="Unordered List"><i class="fas fa-list-ul"></i></button>

                <button onclick="insertLink()" title="Insert link"><i class="fas fa-link" ></i></button>
                <button onclick="execCommand('unlink')" title="Remove link"><i class="fas fa-unlink"></i></button>

                <button onclick="insertTable()" title="Insert Table"><i class="fas fa-table"></i></button>
                <button onclick="execCommand('removeFormat')">Clear Format</button>
            </div>