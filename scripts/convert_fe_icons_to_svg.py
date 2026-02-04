from __future__ import annotations

import base64
from pathlib import Path

FOLDER = Path(r"C:\xampp\htdocs\CCE\assets\image\FE-icons")


def main() -> None:
    for jpg in FOLDER.glob("*.jpeg"):
        data = jpg.read_bytes()
        b64 = base64.b64encode(data).decode("ascii")
        svg = (
            '<?xml version="1.0" encoding="UTF-8"?>\n'
            '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" '
            'width="1" height="1" viewBox="0 0 1 1">\n'
            '  <image width="1" height="1" x="0" y="0" '
            f'xlink:href="data:image/jpeg;base64,{b64}"/>\n'
            "</svg>\n"
        )
        out = jpg.with_suffix(".svg")
        out.write_text(svg, encoding="utf-8")
        print(f"Wrote {out.name}")


if __name__ == "__main__":
    main()
