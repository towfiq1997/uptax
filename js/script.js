const searchinput = document.getElementById("getnidno");
const divtopush = document.getElementById("push_item");
const fieldset_attr = document.getElementById("fieldset_attr");
const toogle_handler = document.querySelectorAll(".toogle_handler");
const single_tax_data = document.querySelectorAll(".single-tax-data");
const push_container = document.getElementById("t_container");
const assid = document.getElementById("assid");
const myform = document.getElementById("myForm");
const trcontainer = document.getElementById("tr_container");
const assessearch = document.getElementById("assesment_search");

if (assessearch) {
  assessearch.addEventListener("change", (e) => {
    console.log(e.target.dataset.code);
    const year = {
      getyear: 1,
      year: Number(e.target.dataset.code),
      holding: e.target.value,
    };
    const getasstable = async () => {
      try {
        const res = await fetch("post.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(year),
        });
        const result = await res.json();
        trcontainer.innerHTML = result.tablerow;
        console.log(result.tablerow);
      } catch (error) {
        const error_msg = ``;
      }
    };
    getasstable();
  });
}

if (searchinput) {
  searchinput.addEventListener("change", (e) => {
    console.log(999);
    divtopush.innerHTML = "";
    push_container.innerHTML = "";
    if (e.target.value == "") {
      const msg = `<div style="height:500px" class="d-flex justify-content-center align-items-center">
                                <div class="alert alert-primary bangla" role="alert">
                                    উপেরের ইনপুট বক্সে এনআইডি নং দিয়ে তথ্য যাছাই এর পর ট্যাক্স এড করুন
                                </div>
                            </div>`;
      divtopush.innerHTML = msg;
      return;
    }
    fieldset_attr.setAttribute("disabled", "disabled");
    const nid = {
      getnid: 1,
      unionCode: e.target.dataset.unioncode,
      nid: Number(e.target.value),
    };
    console.log(e.target.value);
    console.log(searchinput.value);
    const getassdata = async () => {
      try {
        const res = await fetch("post.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(nid),
        });
        const result = await res.json();
        divtopush.innerHTML = result.p_data;
        //t_container.innerHTML = result.res2;
        // console.log(result);
        // console.log(result.res2);
        // console.log(divtopush);
        // console.log(assid.value);
        fieldset_attr.removeAttribute("disabled");
        assid.value = searchinput.value;
      } catch (error) {
        const error_msg = `<div style="height:500px" class="d-flex justify-content-center align-items-center"><div class="alert alert-warning" role="alert">
                                    উপরোক্ত এনআইডির কোন তথ্য পাওয়া যাইনি সঠিক তথ্য দিয়ে আবার চেষ্টা করুন
                                </div>
                            </div>`;
        divtopush.innerHTML = error_msg;
      }
    };
    getassdata();
  });
}

/////

//End of table

toogle_handler.forEach((single_toggle) => {
  document.addEventListener("click", (e) => {
    console.log(e.target);
    const matchnode = e.target;
    console.log(matchnode);
    console.log(single_toggle);
    const single_data = e.target.parentNode.parentNode.parentNode;
    // single_tax_data.forEach((s) => {
    //   if (single_data !== s) {
    //     const tax_body2 = s.querySelector(".tax-main-content");
    //     tax_body2.classList.add("d-none");
    //     console.log(e.currentTarget.parentNode.parentNode);
    //     console.log(s);
    //   }
    // });
    const tax_body = single_data.querySelector(".tax-main-content");
    if (
      single_data
        .querySelector(".tax-main-content")
        .classList.contains("d-none")
    ) {
      console.log(single_data.firstChild.classList);
      //single_data.lastChild.classList.add("new");

      single_data.querySelector(".tax-main-content").classList.remove("d-none");
      console.log(tax_body.classList);
    } else {
      single_data.querySelector(".tax-main-content").classList.add("d-none");
      console.log(tax_body.classList);
    }
  });
});
