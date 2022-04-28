const myForm = document.getElementById("myForm");
const ownername = document.getElementById("name");
const profile_pic = document.getElementById("profile_pic");
const nid = document.getElementById("nid_pic");

myForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const p_pic = profile_pic.files[0];
  const nid_pic = nid.files[0];
  const o_name = ownername.value;
  const form_data = new FormData();
  form_data.append("profilee_pic", p_pic);
  form_data.append("owner_name", o_name);

  const sendTest = () => {
    fetch("test.php", {
      method: "post",
      body: form_data,
    })
      .then((res) => res.json())
      .then((items) => {
        console.log(items);
        const nested_form = new FormData();
        nested_form.append("nested_post", items.item);
        return fetch("newtest.php", {
          method: "post",
          body: nested_form,
        })
          .then((res2) => res2.json())
          .then((item2) => console.log(item2));
      });
    // const res = await fetch("test.php", {
    //   method: "post",
    //   body: form_data,
    // });
    // const resdata = await res.json();
    // console.log(resdata);
    // const nested_form = new FormData();
    // nested_form.append("nested_post", "87");
    // const nestedres = await fetch("newtest.php", {
    //   method: "post",
    //   body: nested_form,
    // });
    // const nesteddata = await nestedres.json();
    // console.log(nesteddata);
  };
  console.log(e);
  console.log(nid);
  sendTest();
});
