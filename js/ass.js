const assesmentForm = document.getElementById("assesmentForm");
const fam_container = document.getElementById("fam_container");
const addmore = document.getElementById("addmore");
const family_input = document.getElementById("family_input");
const f_sub = document.getElementById("f_sub");
const overlay = document.querySelector(".overlay");

assesmentForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const uni_code = document.getElementById("getunicode").dataset.lastid;
  const ward = document.getElementById("ward").value;
  const holding = document.getElementById("holding").value;
  const ownername = document.getElementById("ownername").value;
  const fname = document.getElementById("fname").value;
  const mname = document.getElementById("mname").value;
  const village = document.getElementById("village").value;
  const profilephoto = document.getElementById("profilephoto").files[0];
  const nidphoto = document.getElementById("nidphoto").files[0];
  const nid = document.getElementById("nid").value;
  const mobile = document.getElementById("mobile").value;
  const occupation = document.getElementById("occupation").value;
  const type = document.getElementById("type").value;
  const price = document.getElementById("price").value;
  const tax = document.getElementById("tax").value;
  const due = document.getElementById("due").value;
  const line = document.getElementById("line").value;
  const land = document.getElementById("land").value;
  if (
    ward === "" ||
    holding === "" ||
    ownername === "" ||
    fname === "" ||
    mname === "" ||
    nid === "" ||
    mobile === "" ||
    tax === "" ||
    price === ""
  ) {
    console.log(profilephoto);
  } else {
    console.log(profilephoto);
    overlay.style.display = "block";
    const form_data = new FormData();
    form_data.append("ward", ward);
    form_data.append("holding", holding);
    form_data.append("ownername", ownername);
    form_data.append("fname", fname);
    form_data.append("mname", mname);
    form_data.append("village", village);
    form_data.append("profilephoto", profilephoto);
    form_data.append("nidphoto", nidphoto);
    form_data.append("nid", nid);
    form_data.append("mobile", mobile);
    form_data.append("occupation", occupation);
    form_data.append("type", type);
    form_data.append("price", price);
    form_data.append("tax", tax);
    form_data.append("due", due);
    form_data.append("line", line);
    form_data.append("land", land);
    form_data.append("union_code", uni_code);
    fetch("inc/post.php", {
      method: "post",
      body: form_data,
    })
      .then((res) => res.json())
      .then((resData) => {
        console.log(resData);
        if (resData.error) {
          location.assign("assinput?message=Error Occured&status=error");
        } else if (resData.last_id) {
          const inppp = family_input.querySelectorAll("input");
          const slectt = family_input.querySelectorAll("select");
          const myarray = {
            sendid: 1,
            assesid: resData.last_id,
            members: [],
          };
          const length = inppp.length - 1;
          for (let i = 0; i <= length; i++) {
            const name = inppp[i].value;
            const occupation = slectt[i].value;
            const memobj = {
              name,
              occupation,
            };
            myarray.members.push(memobj);
          }

          fetch("post.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(myarray),
          })
            .then((res2) => res2.json())
            .then((resdata2) => {
              if (resdata2.response) {
                overlay.style.display = "none";
                location.assign(
                  "assinput?message=Error Occured&status=success"
                );
              } else {
                overlay.style.display = "none";
                location.assign("assinput?message=Error Occured&status=error");
              }
            });
        }
      });
  }
});
//f_sub
fam_container.addEventListener("click", (e) => {
  const target = e.target;
  if (target.matches("i")) {
    target.parentNode.parentNode.removeChild(target.parentNode);
  }
});
f_sub.addEventListener("click", () => {
  const inppp = family_input.querySelectorAll("input");
  const slectt = family_input.querySelectorAll("select");
  const myarray = {
    members: [],
    assesId: 99,
  };
  const length = inppp.length - 1;
  for (let i = 0; i <= length; i++) {
    const name = inppp[i].value;
    const occupation = slectt[i].value;
    const memobj = {
      name,
      occupation,
    };
    myarray.members.push(memobj);
  }

  console.log(myarray);
});

//ADDMOREFAMILY

addmore.addEventListener("click", () => {
  const textinp = document.createElement("input");
  const div = document.createElement("div");
  const select = document.createElement("select");
  const icon = document.createElement("i");
  const option1 = document.createElement("option");
  const option2 = document.createElement("option");
  const option3 = document.createElement("option");

  const text_node1 = document.createTextNode("ছাত্র/ছাত্রি");
  const text_node2 = document.createTextNode("চাকুরি");
  const text_node3 = document.createTextNode("অন্যন্য");

  option1.appendChild(text_node1);
  option2.appendChild(text_node2);
  option3.appendChild(text_node3);

  option1.setAttribute("value", "student");
  option2.setAttribute("value", "chakuri");
  option3.setAttribute("value", "others");

  icon.classList.add("fa", "fa-times");
  icon.setAttribute("aria-hidden", "true");

  select.appendChild(option1);
  select.appendChild(option2);
  select.appendChild(option3);

  div.classList.add(
    "d-flex",
    "justify-content-center",
    "align-items-center",
    "mb-3"
  );
  textinp.setAttribute("type", "text");
  textinp.setAttribute("placeholder", "নাম");
  div.appendChild(textinp);
  div.appendChild(select);
  div.appendChild(icon);
  fam_container.appendChild(div);
});

// Table
